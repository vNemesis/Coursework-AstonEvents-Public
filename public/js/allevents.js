// clears all filter and search fields
function clearFilter(refresh)
{
  document.getElementById('filterCategory').value = "";
  document.getElementById('filterDateMethod').value = "";
  document.getElementById('filterDate').value = "";
  document.getElementById('filterLikenessMethod').value = "";
  document.getElementById('filterLikeness').value = "";
  document.getElementById('sortby').value = "";
  document.getElementById('searchTextMethod').value = "";
  document.getElementById('searchText').value = "";

  // if refresh button is pressed submit an empty form
  if(refresh == true)
  {
    document.getElementById("filterForm").submit();
  }
}

// this will ensure data is valid in query passed
function validateFilter()
{
  var canSubmit = true;
  var error = "";

  // Is a filtered date set?
  if(document.getElementById('filterDateMethod').value != "")
  {
    if (document.getElementById('filterDate').value != "")
    {
      canSubmit = true;
    }
    else
    {
      canSubmit = false;
      error = error + " <li class='error' >Error with Date filter, Please ensure you have a date set!</li>";
    }
  }
  else
  {
    if(document.getElementById('filterDate').value != "")
    {
      canSubmit = false;
      error = error + " <li class='error' >Error with date field, Please ensure you have a date method set!</li>";
    }
  }

  // Is a filtered likeness set?
  if(document.getElementById('filterLikenessMethod').value != "") // a method has been set
  {
    if(document.getElementById('filterLikeness').value != "") // if the value is not empty
    {
      canSubmit = true;
    }
    else // else throw an error
    {
      canSubmit = false;
      error = error + " <li class='error' >Error with Interest filter, Please ensure you have an interest value set!</li>";
    }
  }
  else // if the method is empty
  {
    if(document.getElementById('filterLikeness').value != "")
    {
      canSubmit = false;
      error = error + " <li class='error' >Error with interest field, Please ensure you have a interest method set!</li>";
    }
  }

  // Is a search method set?
  if(document.getElementById('searchTextMethod').value != "")
  {
    if(document.getElementById('searchText').value != "")
    {
      canSubmit = true;
    }
    else
    {
      canSubmit = false;
      error = error + " <li class='error' >Error with search field, Please ensure you have a search phrase set!</li>";
    }
  }
  else
  {
    if(document.getElementById('searchText').value != "")
    {
      canSubmit = false;
      error = error + " <li class='error' >Error with search field, Please ensure you have a search method set!</li>";
    }
  }

  if(canSubmit)
  {
    document.getElementById("filterForm").submit();
  }
  else
  {
    document.getElementById('filterNotif').hidden = false;
    document.getElementById('filterNotif').innerHTML = error;
  }
}
