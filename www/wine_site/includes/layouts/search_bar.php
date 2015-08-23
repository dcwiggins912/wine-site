<script type="text/javascript">
  function changeName() {
    var field = document.getElementById("search-field");
    var search_type = document.getElementById("search-type");
    field.name = search_type.options[search_type.selectedIndex].text.toLowerCase();
  }

</script>
<div id="search-bar">
  <form action="wine_search.php" method="get">
    <label>Search by:</label>
    <select id="search-type">
      <option>Name</option>
      <option>Varietal</option>
      <option>Region</option>      
    </select>
    <input id="search-field" type="text" name="q" style="width: 150px; "/>
    <input type="submit" value="Search" style="width: 75px;" onclick="changeName()"/>
  </form>
</div>