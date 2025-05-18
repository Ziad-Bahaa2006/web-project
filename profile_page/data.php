<?php
// Database connection info
$host = "localhost";
$port = "5432";
$dbname = "players_info";
$user = "postgres";
$password = "datakey233";

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Query
$query = "SELECT * FROM players_info";
$result = pg_query($conn, $query);

// Output results
echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Level</th>
        <th>Member Since</th>
        <th>Bio</th>
        <th>Matches Played</th>
        <th>Win Rate</th>
        <th>Points</th>
        <th>Achievements</th>
      </tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['player_name']}</td>
            <td>{$row['level']}</td>
            <td>{$row['member_since']}</td>
            <td>{$row['bio']}</td>
            <td>{$row['matches_played']}</td>
            <td>{$row['win_rate']}</td>
            <td>{$row['points']}</td>
            <td>{$row['achievements']}</td>
          </tr>";
}

echo "</table>";

// Close connection
pg_close($conn);
?>
