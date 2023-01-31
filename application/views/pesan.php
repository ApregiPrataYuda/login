

<?php if ($this->session->has_userdata('error')) { ?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>!</strong> <?=strip_tags(str_replace('</p>','',$this->session->flashdata('error')));?>.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>