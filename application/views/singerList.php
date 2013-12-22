
<h1><?php echo $title; ?></h1>
		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />

<script type="text/javascript">
    var datatable;
    //if( typeof dataTable == 'undefined' )
        dataTable = $( '#list_table' ).dataTable({"bJQueryUI": true});
    //console.log(datatable);

</script>

        <?php echo anchor('singer/add/','add new data',array('class'=>'add')); ?>
