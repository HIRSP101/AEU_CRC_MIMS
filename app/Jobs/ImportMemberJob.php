<?php

namespace App\Jobs;

use App\Events\ImportProgress;
use App\Services\ImportProgressService;
use App\Services\Members\CreateMemberService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Exception;

class ImportMemberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $members;
    private ?array $image;
    private int $currentMemberId;
    private int $totalMembers;
    private int $batchIndex;

    public function __construct(array $members, ?array $image, int $currentMemberId, int $totalMembers, int $batchIndex)
    {
        $this->members = $members;
        $this->image = $image;
        $this->currentMemberId = $currentMemberId;
        $this->totalMembers = $totalMembers;
        $this->batchIndex = $batchIndex;
    }

    public function handle(CreateMemberService $createService, ImportProgressService $progressService): void
    {
        try {
            DB::beginTransaction();

            foreach ($this->members as $index => $memberData) {
                try {
                    $createService->createMember(
                        $memberData,
                        $this->image ? $this->image[$index] : null,
                        $this->currentMemberId + $index
                    );

                    $processedCount = ($this->batchIndex * config('queue.chunk_size')) + $index + 1;
                    $progressService->updateProgress(
                        $processedCount,
                        'Processing members...'
                    );
                } catch (Exception $e) {
                    $progressService->updateProgress(
                        $processedCount,
                        'Processing members...',
                        [['data' => $memberData, 'error' => $e->getMessage()]]
                    );
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $progressService->failProgress($e->getMessage());
            throw $e;
        }
    }
}
