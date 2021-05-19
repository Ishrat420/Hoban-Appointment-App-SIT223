function validate()
{
    if(document.getElementById("f_slot_id").value == "0")
    {
      alert("Please select a slot");
      return false;
    }
    return true;
}
function selectSlot(div)
{
    var appSlot = document.getElementsByClassName("appointmentSlot");
    var i;
    for (i = 0; i < appSlot.length; i++) {
      appSlot[i].style.backgroundColor = "white";
      appSlot[i].style.color = "#4c72fb";
    }


    var slotDiv = document.getElementById(div);
    var slot_id = slotDiv.querySelector("#slot_id").value;
    document.getElementById("f_slot_id").value=slot_id;
    
    document.getElementById("slot").value=slotDiv.querySelector("#slot_v").innerHTML;


    slotDiv.parentNode.style.backgroundColor = 'blue';
    slotDiv.parentNode.style.color = 'white';
  
}