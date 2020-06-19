<div class="container">
  <div class="row">
    <div id="admin" class="col s12 m12 l12">
    <div class="card material-table z-depth-3">
      <div class="table-header">
        <span class="table-title">Users</span>
        <div class="actions">
          <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
        </div>
      </div>
      <table id="datatable" class="striped">
        <thead>
          <tr>
            <th width="8%">Image</th>
            <th width="10%">User ID</th>
            <th width="25%">Name</th>
            <th width="18%">Account Status</th>
            <th width="15%">Access Level</th>
            <th width="10%">Details</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($this->data)) { ?>
            <?php foreach ($this->data as $value) { ?>
              <tr>
                <td><img src="<?php echo URL ?>public/img/<?php echo $value['uImage']; ?>" alt="" width="40px" height="40px"></td>
                <td><?php echo $value['u_id']; ?></td>
                <td><?php echo $value['uName']; ?></td>
                <td><?php echo $value['uActive']; ?></td>
                <td><?php echo $value['aLevel']; ?></td>
                <td><?php echo $value['action'] ?></td>
              </tr>
            <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
<div class="modal modal-fixed-footer" id="userModal">
  <div class="modal-content">
    <h4>User Details</h4>
    <div class="row">
      <div class="col s12 m2 l2 offset-m4 offset-l4">
        <img src="" alt="" id="u_img" width="180px" height="180px">
      </div>
      <div class="col s12 m8 l8 offset-m2 offset-l2">
        <div class="input-field">
          <input type="text" id="uId" value="" >
          <label for="uId">User ID</label>
        </div>
        <div class="input-field">
          <input type="text" id="u_name" value="" >
          <label for="u_name">Name</label>
        </div>
        <div class="input-field">
          <select id="u_type" name="utype">
            <option value="Visitor">Visitor</option>
            <option value="Encoder">Encoder</option>
          </select>
          <label for="u_type">Access Level</label>
        </div>
        <input type="hidden" id="userid" value="">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a id="save" class="modal-submit waves-effect waves-light btn blue">Save</a>
  </div>
</div>

<a id="toastfail" onclick="M.toast({html: 'Action Failed'})" class="btn" style="visibility: hidden">toast</a>
