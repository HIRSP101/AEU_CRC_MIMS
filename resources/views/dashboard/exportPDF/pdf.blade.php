<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Table Example</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Siemreap&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: "Siemreap", sans-serif;
        background-color: #ffffff;
      }

      .table-container {
        overflow-x: auto;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        min-width: 400px;
        border: 1px solid #dddddd;
        background-color: #fff;
      }

      table thead {
        /* background-color: #696666; */
        color: #000000;
      }

      table th {
        padding: 12px;
        text-align: left;
        border: 1px solid #dddddd;
      }
      table td{
        padding: 9px;
        text-align: left;
        border: 1px solid #dddddd;
      }

      table tr {
        border-bottom: 1px solid #dddddd;
      }

      /* table tr:nth-of-type(even) {
        background-color: #f3f3f3;
      } */

      table tr:last-of-type { 
        border-bottom: 2px solid #333;
      }
    </style>
  </head>
  <body>
    <h3 class="align-self: center">
      Cambodia Red Cross
    </h3>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>kh-name</th>
            <th>en-name</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th>Position</th>
            <th>School</th>
            <th>Year</th>
            <th>Expire</th>
            <th>Location</th>
            <th>Major</th>
            <th>Phone</th>
            <th>Size</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <tr>
            <td>1</td>
            <td>663</td>
            <td>Sok Sothea</td>
            <td>Sok Sothea</td>
            <td>Male</td>
            <td>02 Feb 1985</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>098 555 710</td>
            <td>L</td>
          </tr>
          <tr>
            <td>2</td>
            <td>664</td>
            <td>Chhorn Kimseu</td>
            <td>Chhorn Kimseu</td>
            <td>Male</td>
            <td>14 Mar 1990</td>
            <td>Manager</td>
            <td>AEU</td>
            <td>2024</td>
            <td>31 12 2025</td>
            <td>Phnom penh</td>
            <td>IT</td>
            <td>096 742 566</td>
            <td>M</td>
          </tr>
          <!-- Add more rows as per the content in your image -->
        </tbody>
      </table>
    </div>
  </body>
</html>
