<?php
    echo '';
?>
<div class="container">
    <h4 align=center> Portals dashboard </h4>
    
    <table class="table" data-toggle="table" data-url="data1.json" data-cache="false" data-height="299">
        <thead>
            <tr>
                <th data-field="id">Portal ID</th>
                <th data-field="name">Portal Name</th>
                <th data-field="price">Portal Url</th>
                <th data-field="price"></th>
                <th data-field="price"></th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach($this->portals as $portal) :?>
            <tr>
                
                <td>
                    <?php echo $portal['id_prt'];?>
                </td>
                
                <td>
                    <?php echo $portal['name_prt']?>
                </td>
                
                <td>
                    <?php echo $portal['url_prt']?>
                </td>
                
                <td>
                    <a href="<?php echo $this->url('admin/edit' , array('id' => $portal['id_prt']))?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                </td>
                
                <td>
                    <a href="<?php echo $this->url('admin/delete' , array('id' => $portal['id_prt']))?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                </td>
                
            </tr>
            
            <?php endforeach;?>
        </tbody>
        
    </table>
    
    <a href="<?php echo $this->url('admin/new');?>" class="btn btn-primary">Adauga poral</a>
</div>