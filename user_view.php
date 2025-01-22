<?php
include './user_header.php';

if (!isset($_GET['id']) || strlen($_GET['id']) < 1 || !ctype_digit($_GET['id'])) {
    echo '<script> history.back()</script>';
    exit();
}

require_once './src/requester.php';
require_once './src/team.php';
require_once './src/ticket.php';
require_once './src/ticket-event.php';
require_once './src/team-member.php';
require_once './src/comment.php';

$err = '';
$msg = '';
$ticket = Ticket::find($_GET['id']);
$teams = Team::findAll();
$events = Event::findByTicket($ticket->id);
$comments = Comment::findByTicket($ticket->id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $team = $_POST['team_member'];
        $id = $_GET['id'];

        try {
            $ticket->team_member = $team;
            $ticket->update($id);
            $msg = "Ticket assigned successfully";
        } catch (Exception $e) {
            $err = "Failed to assign ticket";
        }
    }

    if (isset($_POST['comment'])) {
        $body = $_POST['body'];

        try {
            $comment = new Comment([
                'ticket-id' => $ticket->id,
                'team-member' => $ticket->team_member,
                'body' => $body,
            ]);
            $comment->save();
            $msg = "Successfully commented on the ticket";
        } catch (Exception $e) {
            $err = "Failed to comment on the ticket";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <style>
        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <?php include 'user_sidebar.php'; ?>
    <div id="content-wrapper" class="centered-container">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Ticket Details</li>
            </ol>
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row mx-auto">
                        <div>
                            <?php echo $ticket->displayStatusBadge(); ?>
                            <small class="text-info ml-2">
                                <?php echo $ticket->title; ?>
                                <span class="text-muted">
                                    <?php echo (new DateTime($ticket->created_at))->format('d-m-Y H:i:s'); ?>
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($err)) : ?>
                        <div class="alert alert-danger text-center my-3" role="alert">
                            <strong>Failed! </strong><?php echo $err; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($msg)) : ?>
                        <div class="alert alert-success text-center my-3" role="alert">
                            <strong>Success! </strong><?php echo $msg; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <!-- Team Dropdown -->
                        <div class="form-group row col-lg-8 offset-lg-2 col-md-8 col-sm-12 offset-md-2" style="margin-top: 10px;">
                            <label for="team-dropdown" class="col-sm-3 col-form-label text-right">Team</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="team-dropdown" name="team_member">
                                    <option>--select--</option>
                                    <?php foreach ($teams as $team): ?>
                                        <option value="<?php echo $team->id; ?>" <?php echo $team->id == $ticket->team ? 'selected' : ''; ?>>
                                            <?php echo $team->department; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Ticket Details -->
                        <div class="form-group row col-lg-8 offset-lg-2 col-md-8 col-sm-12 offset-md-2" style="margin-top: 10px;">
                            <label for="details" class="col-sm-3 col-form-label text-right">Details</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" readonly><?php echo $ticket->body; ?></textarea>
                            </div>
                        </div>

                        <!-- Comment Section -->
                        <div class="form-group row col-lg-8 offset-lg-2 col-md-8 col-sm-12 offset-md-2" style="margin-top: 10px;">
                            <label for="body" class="col-sm-3 col-form-label text-right">Comment</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                        </div>

                        <!-- Add Comment Button -->
                        <div class="form-group row col-lg-8 offset-lg-2 col-md-8 col-sm-12 offset-md-2 text-center" style="margin-top: 10px;">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <button type="submit" name="comment" class="btn btn-success">Add Comment</button>
                            </div>
                        </div>
                    </form>

                    <div class="list-group mt-4">
                        <?php foreach ($comments as $c): ?>
                            <a href="#" class="list-group-item list-group-item-action">
                                <h6 class="mb-1"> <?php echo TeamMember::getName($c->team_member); ?> </h6>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-1"> <?php echo $c->body; ?> </p>
                                    <small> <?php echo (new DateTime($c->created_at))->format('d-m-Y H:i:s'); ?> </small>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>&copy; 2024 AssisTechX. All rights reserved.</span>
            </div>
        </div>
    </footer>
</div>

<?php include './footer.php'; ?>
<script>
    document.querySelector('#formData').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        document.querySelector('#msg').innerHTML = '<div class="alert alert-info text-center">Processing...</div>';

        fetch('./src/update-ticket.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(result => {
              const msgContainer = document.querySelector('#msg');
              if (result.status === 200) {
                  msgContainer.innerHTML = `<div class="alert alert-success text-center">${result.msg}</div>`;
              } else {
                  msgContainer.innerHTML = `<div class="alert alert-danger text-center">${result.msg}</div>`;
              }
          });
    });
</script>
</body>
</html>