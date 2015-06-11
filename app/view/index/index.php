<div class="container main">
    <h3> Current Browser is : <em><strong><?php echo $this->browser->getNameBrt();?></strong></em> </h3>
    
    <h5> Portals entries : </h5>
    
    <ul>
        <?php foreach( $this->portals as $portal) :?>
        <li><?php echo $portal['name_prt']?> -- <?php echo $portal['rate']?>% </li>
        <?php endforeach;?>
    </ul>
    
    
    <h4> Redirect to :  </h4>
    
    <br /><br />
        <?php foreach($this->portals as $portal) :?>
        <!--<pre/><?php print_r($portal);?></pre>-->
        <?php endforeach; ?>  
</div>

