<div class="container main">
    <h3> Current Browser is : <em><strong><?php echo $this->browser->getNameBrt();?></strong></em> </h3>
    
    <h5> Portals entries : </h5>
    
    <ul class="col-md-12" style="list-style : none;">
        <?php foreach( $this->portals as $portal) :?>
        <li class="col-md-12">
            <span class="col-md-2"><?php echo $portal->getNamePrt()?></span>
            <span class="col-md-1 text-center"><i class="fa fa-arrow-circle-right"></i> </span>
            <span class="col-md-2"><?php echo $portal->getRates()[0]->getRate();?>% </span>
        </li>
        <?php endforeach;?>
    </ul>
    
    <!--<strong>Roll : <?php echo $this->change;?></strong>-->
    
    <h4> Redirect to :  <em><a target="_blank" href="<?php echo $this->selPortal->getUrlPrt();?>"><?php echo $this->selPortal->getNamePrt();?></a></em></h4>
    
    <br /><br />
        <?php foreach($this->portals as $portal) :?>
        <!--<pre/><?php print_r($portal);?></pre>-->
        <?php endforeach; ?>  
</div>

