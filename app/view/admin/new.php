<div class="container">
    
    <h4 class="text-center">Add new portal</h4>
    
    <form class="" action="<?php echo $this->url('admin/newPost')?>" method="POST">
        
        <label for="">Portal Name</label>
        <input type="text" class="form-control" name="name_prt" />
        <label for="">Portal Url</label>
        <input type="text" class="form-control" name="url_prt" />
        
        <?php foreach($this->browsers as $brs) :?>
        <!-- <pre><?php //var_dump($brs); ?> </pre> -->
        <label> Ratio pentru : <?php echo $brs->getNameBrt()?> (%) </label>
        <input type="number" name="BrowserRate[<?php echo $brs->getIdBrt();?>]" class="form-control" value="1" />
        
        <?php endforeach;?>
        
        <br /><br />
        
        <button class="btn btn-primary">Salveaza</button>
    </form>
    
</div>