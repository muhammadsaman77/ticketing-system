<!DOCTYPE html>
<html lang="en">

<body>
  <h2>Halo, {{$name}}</h2>  
  <p>Ini adalah notifikasi dari Ticketing System</p>
  @if ($status== "OPEN")
    <p>Ticket anda sedang dalam status OPEN</p>
  @elseif($status == "IN_PROGRESS")
    <p>Ticket anda sedang dikerjakan oleh {{$role}} yaitu {{$handler }} </p>
  @elseif($status == "PENDING_USER_ACTION")
    <p>Ticket anda sedang dalam status PENDING_USER_ACTION</p>
  @elseif($status == "RESOLVED")
  <p>Ticket anda sedang dalam status RESOLVED</p>
  @elseif($status == "CLOSED")
  <p>Ticket anda sedang dalam status CLOSED</p>
  @elseif($status == "CANCELLED")
  <p>Ticket anda sedang dalam status CANCELLED</p>
  
    @endif
  
</body>
</html>