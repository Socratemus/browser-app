<div class="container">
    
    <h4 class="text-center">Edit portal</h4>
    
    <form class="" action="<?php echo $this->url('admin/editPost')?>" method="POST">
        
        <?php //var_dump($this->portal);exit();?>
        
        <input type="hidden" name="id_prt" value="<?php echo $this->portal->getIdPrt()?>">
        <label for="">Portal Name</label>
        <input type="text" class="form-control" value="<?php echo $this->portal->getNamePrt();?>" name="name_prt" />
        <label for="">Portal Url</label>
        <input type="text" class="form-control" value="<?php echo $this->portal->getUrlPrt();?>" name="url_prt" />
        
        <?php $rates = $this->portal->getRates();?>        
        <?php foreach($this->browsers as $brs) :?>
        <!-- <pre><?php //var_dump($brs); ?> </pre> -->
        <label> Ratio pentru : <?php echo $brs->getNameBrt()?> (%) </label>
        <input type="number" name="BrowserRate[<?php echo $brs->getIdBrt();?>]" class="form-control" value="<?php echo isset($rates[$brs->getIdBrt()]) ? $rates[$brs->getIdBrt()]->getRate() : 1 ?>" />
        
        <?php endforeach;?>
        
        <br />
        
        <button class="btn btn-primary">Salveaza</button>
    </form>
    
</div>