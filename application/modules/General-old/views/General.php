<script>
  // CONVERT DATE TO FULL DATE --ir 
  function convertDate(d) {
  	var weekday 	= ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
  	var monthList = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
  	var date = new Date(d)
  	date = weekday[date.getDay()]+", "+("0"+date.getDate()).slice(-2)+" "+monthList[date.getMonth()]+" "+date.getFullYear()
  	return date
  }

  // CONVERT NULL TO BLANK --ir
  function nullToBlank(value) {
		return !(value) ? "" : value;
	}

	// CALL FUNCTION SELECT PICKER --ir
  function select(){
    $(function() {
      $('.selectpicker').selectpicker();
    });
  }

  // RESET SELECTPICKER --ir
  function refreshSelect(){
    $(function() {
      $('.selectpicker').selectpicker('refresh');
    });
  }
</script>