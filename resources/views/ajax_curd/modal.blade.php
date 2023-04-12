

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header py-2">

        <h5 class="modal-title" id="modalTitle"> </h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <h5 class="text-success text-center" id="success"></h5>
        <h5 class="text-danger text-center" id="error"></h5>

        <form class="admit-form" id="admit-form" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="updateId">
            <div class="mb-2">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" class="form-control" name="name">
            </div>
            <div class="mb-2">
                <label for="mail" class="form-label">Mail Address</label>
                <input type="email" id="mail" class="form-control" name="mail">
            </div>
            <div class="mb-2">
                <label for="phone" class="form-label">Phone No</label>
                <input type="text" id="phone" class="form-control" name="phone">
            </div>
            <div class="mb-2">
                <label for="roll" class="form-label">Roll No</label>
                <input type="number" id="roll" class="form-control" name="roll">
            </div>
            <div class="mb-2">
                <label for="reg" class="form-label">Registration No</label>
                <input type="number" id="reg" class="form-control" name="reg">
            </div>
            <div class="mb-2" id="selectBoard">

            </div>
            <div class="mb-2" id="selectSession">

            </div>
            <div class="mb-2">
                <label for="avatar" class="form-label">Profile Image</label>
                <input type="file" id="avatar" class="form-control" name="avatar">
                <div id="proImg"></div>

            </div>
            <div class="text-end">
                <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                <button type="submit" class="btn btn-sm btn-primary sub_btn"></button>
              </div>

       </form>
      </div>


    </div>
  </div>
</div>
