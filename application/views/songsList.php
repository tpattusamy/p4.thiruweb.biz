
		<h1>Tamil songs Database</h1>
		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />

        <script type="text/javascript">
            var datatable;
            if( typeof dataTable == 'undefined' )
                dataTable = $( '#list_table' ).dataTable({"bJQueryUI": true});


        </script>
        <?php echo anchor('songs/add/','add new data',array('class'=>'add')); ?>
