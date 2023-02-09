<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Traffic', 'Per View'],
           <?php  foreach($trafict as $key => $value) { ?>
           ['<?php echo $value[0]; ?>',    <?php echo $value[1]; ?>],
           <?php } ?>
          
        ]);

        var options = {
          title: 'Traffic Sources',
		   width: 480,
			height: 250,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChartLine);
      function drawChartLine() {
      
        var data = google.visualization.arrayToDataTable([
        ['Time Period', 'Visitor', 'Page view'],

        <?php foreach($stats as $key => $value) { ?>          
        ['<?php echo $key%4==0?$key:'';?>', <?php echo $value[1].','.$value[2]; ?>],
        <?php } ?>
        ]);
        var options = {
          title: 'Page View',
		  width: 420,
			height: 250,
          hAxis: {title: 'Day',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_line'));
        chart.draw(data, options);
      }
    </script>
    
      <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["table"]});
      google.setOnLoadCallback(drawTable);

      function drawTable() {  
        var data = google.visualization.arrayToDataTable([
       ['City', 'Viewer'],
        <?php foreach($city as $key => $value) { ?>
        ['<?php echo $value[0]?>', <?php echo $value[1]?>],
        <?php } ?>

      
      ],
      false); // 'false' means that the first row contains labels, not data.


        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '200px', height: '250'});
      }
    </script>