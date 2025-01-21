<?php
require_once './src/team-member.php';

if (isset($_POST['team_id']) && ctype_digit($_POST['team_id'])) {
    $teamId = $_POST['team_id'];
    $teamMembers = TeamMember::findByTeam($teamId); // Fetch team members by team ID

    if ($teamMembers) {
        echo json_encode([
            'status' => 200,
            'data' => $teamMembers
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'message' => 'No members found for the selected department.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 400,
        'message' => 'Invalid team ID.'
    ]);
}
