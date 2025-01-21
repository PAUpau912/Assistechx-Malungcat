<?php
require_once './src/ticket.php';

if(isset($_GET['ticket_id']) && is_numeric($_GET['ticket_id'])){
    $ticketId = (int)$_GET['ticket_id'];

    try{
        //update the reported field in the db
        Ticket::updateReportedTicket($ticketId);

        header("Location: admin.php?status=success&message=Ticket+reported+successfully");
        exit;
    }catch(Exception $e){
        header("Location: admin.php?status=error&message= ".urlencode($e->getMessage()));
        exit;
    }
}
else{
    header("Location: admin.php?status=error&message=Invalid+ticket+ID");
}
?>
