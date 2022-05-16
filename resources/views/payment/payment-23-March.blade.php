<!DOCTYPE html>
<html>

<body>
  <form id="myForm" action="{{url('vendor-payment-bharatkosh')}}" method="post">
    @csrf
    <input type="text" name="fname" id="fname">
    <input type="text" name="lname" id="lname">
    <input type="submit" value="Submit">
  </form>
</body>

</html>