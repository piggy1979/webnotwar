  <style>
    .ai1ec-month-view .ai1ec-date{
      text-align:left;
      font-size:21px;
      font-family: "refrigerator-deluxe",sans-serif;
      color:#898686;
      height: auto;
      line-height: 100%;
    }
    .ai1ec-month-view .ai1ec-event{
      height:auto;
    }
    .ai1ec-month-view .ai1ec-event{
      white-space: normal;
    }
    a.ai1ec-load-view{
      color:#898686;
      font-weight:600 !important;
    }
    a.ai1ec-event-container{
      background-color: #f2efe9;
      border: 1px solid #e9e6df !important;
      color:#666;
      font-style:oblique;
      margin:4px;
      padding:5px;
      border-radius: 3px;
    }
    .ai1ec-month-view td.ai1ec-today div.ai1ec-day div.ai1ec-date{
      background-color: #f6fcfd !important;
    }
    .ai1ec-subscribe-container{
    }
@media all and (max-width: 768px) {
  .ai1ec-month-view thead{
    display:none;
  }
  .ai1ec-month-view td{
    display:block;
  }

  </style>
  <article>

  <section id="events" class="col-sm-12">

  <?php the_content(); ?>

  </section>

  </article>