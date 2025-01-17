@extends('layouts.templates.att.master')
@push('CSS')
    </style>
@endpush

@section('Content')
    <?php
    $converseObj = [];
    foreach ($user_branch as $user_b) {
        $converseObj[$user_b->id] = [
            'name' => $user_b->name,
            'email' => $user_b->email,
            'branch_id' => $user_b->branch_bindding_user[0]->branch->branch_id ?? '',
            'role' => $user_b->roles[0]->name ?? '',
            'permissions' => $user_b->permissions ?? '',
        ];
    }
    ?>
    <div class="bg-gray-100">
        @include('user.partials.createuser')
        <div class="absolute origin-top-right mt-1 right-5">
            <a id="user_form_btn"><img src="{{ asset('images/icons/add-user.png') }}"
                    class="w-auto h-auto bg-gray-300 py-1 px-1 rounded-full" /></a>
        </div>
        <div class="flex items-center justify-center bg-gray-100 font-sans mt-5 overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Branches</th>
                                <th class="py-3 px-6 text-left">Users</th>
                                <th class="py-3 px-6 text-left">Roles</th>
                                <th class="py-3 px-6 text-center">Permission</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($user_branch as $userb)
                                @include('user.partials.userbranch')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('JS')
    <script>
        var converseObj = @json($converseObj);
        console.log(converseObj);
        $("#image").on('change', function(e) {
            e.preventDefault();
            var file = e.target.files;
            previewImage(file);
        });
        $("#user_form_btn").on("click", function() {
            $("#user_form_form_inner").attr('action', "{{ route('register.store') }}");
            $("h1#form_header_text").text("User Create Form");
            $("div#profilepreview").removeClass('hidden');
            formcleanup();
            $("#user_form_inner").toggle('hidden');
        })
        $("button.cancelform").on("click", function(e) {
            e.preventDefault();
            $("#user_form_inner").toggle('hidden');
        })
        $("button#saveprofile").click(function(e) {
            e.preventDefault();
            $("#user_form_form_inner").submit();
        })
        $('.delude').on("click", function() {
            if (confirm("Are you sure you want to delete this user?")) {
                ded('/deleteuser', $(this).attr('data-id'));
            }
        })

        $('.elude').on("click", function() {
            var userObj = converseObj[parseInt($(this).attr('data-id'))];
            var route = `{{ route('user.edit', ':id') }}`;
            route = route.replace(':id', $(this).attr('data-id'));
            $("#user_form_form_inner").attr('action', route);
            $("h1#form_header_text").text("User Edit Form");
            $("div#profilepreview").addClass('hidden');
            $("#user_form_inner").toggle('hidden');
            formcleanup();
            $("input#name_inner").val(userObj["name"]);
            $("input#email_inner").val(`${userObj["email"]}`);
            $(`input#${userObj["role"]}`).prop("checked", true);
            for (let i = 0; i < userObj["permissions"].length; i++) {
                $(`input#${userObj["permissions"][i]["name"].split(' ')[0]}`).prop("checked", true);
            }
            $("select#branch_id").val($(this).attr('b-id')).change();
        })

        function formcleanup() {
            $("input#name_inner").val("");
            $("input#email_inner").val("");
            $("input#password_inner").val("");
            $("input[name='roles[]']").prop("checked", false);
            $("input[name='permissions[]']").prop("checked", false);
            $("select#branch_id").val("").change();
        }

        function ded(url, id) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                    console.log(response.message);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        }

        function previewImage(files) {
            $("#imagepreview").html('');
            $.each(files, function(i, file) {
                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imgElement = $('<img />', {
                            src: e.target.result,
                            css: {
                                maxWidth: '125px',
                                maxHeight: 'auto',
                                border: '2px solid #ddd',
                            }
                        });
                        $("#imagepreview").append(imgElement);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
@endpush
