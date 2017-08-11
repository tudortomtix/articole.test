function ConfirmDelete()
{
  var x = confirm("Esti sigur ca vrei sa stergi?");
  if (x)
      return true;
  else
    return false;
}