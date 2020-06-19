<div class="container">
  <div class="row">
    <div id="admin" class="col s12 m12 l12">
    <div class="card material-table z-depth-3">
      <div class="table-header">
        <span class="table-title">Messages</span>
        <div class="actions">
          <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
        </div>
      </div>
      <table id="datatable" class="striped">
        <thead>
          <tr>
            <th width="5%">ID</th>
            <th width="25%">Name</th>
            <th width="20%">email</th>
            <th width="50%">Message</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($this->data)) { ?>
            <?php foreach ($this->data as $message) { ?>
              <tr>
                <td><?php echo $message['id']; ?></td>
                <td><?php echo $message['name']; ?></td>
                <td><?php echo $message['email']; ?></td>
                <td><?php echo $message['message']; ?></td>
              </tr>
            <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
