<sponsor-list>

  <div class="pure-g">
    <div each="{ list }" class="pure-u-1 pure-u-md-1-2 pure-u-xl-1-3">
      <div class="card">
          <h1 class="card-title">{ sponsor_name }</h1>
          <p class="card-url"><a href="{ sponsor_url }">{ sponsor_url }</a></p>
      </div>
    </div>
  </div>

  <style scoped>
      :scope .card{
          background-color: #eeeeee;
          border-left: 8px solid #00aeef;
          padding: 2% 4%;
          margin-top: 2%;
          margin-right: 2%;         
      }
      :scope .card-title{
        display: block;
      }
      :scope .card-url{
        display: block;
      }
  </style>

  <script>
    var sponsor = document.getElementById("sponsor");
    this.list = JSON.parse(sponsor.getAttribute('data-list'));
  </script>
</sponsor-list>