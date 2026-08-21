 <form action="<?= base_url('dashboard/simpan_menu') ?>" method="post">
     <div class="modal-content">

         <div class="modal-header bg-success">
             <h5 class="modal-title">
                 <i class="fas fa-plus"></i> Tambah Menu Navigasi
             </h5>
             <button type="button" class="close text-white" data-dismiss="modal">
                 <span>&times;</span>
             </button>
         </div>

         <div class="modal-body">
             <div class="row">

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>Nama Menu</label>
                         <input type="text" name="nama_menu" class="form-control" required>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>Slug</label>
                         <input type="text" name="slug" class="form-control">
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>URL (Opsional)</label>
                         <input type="text" name="url" class="form-control">
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>Parent Menu</label>
                         <select name="parent_id" class="form-control">
                             <option value="0">-- Menu Utama --</option>
                             <?php foreach ($menu as $m): ?>
                                 <option value="<?= $m['id'] ?>">
                                     <?= $m['nama_menu'] ?>
                                 </option>
                             <?php endforeach; ?>
                         </select>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>Urutan</label>
                         <input type="number" name="urutan" class="form-control" value="1">
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>Posisi</label>
                         <select name="posisi" class="form-control">
                             <option value="header">Header</option>
                             <option value="footer">Footer</option>
                         </select>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>Target</label>
                         <select name="target" class="form-control">
                             <option value="_self">_self</option>
                             <option value="_blank">_blank</option>
                         </select>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-group">
                         <label>Status</label>
                         <select name="is_active" class="form-control">
                             <option value="1">Aktif</option>
                             <option value="0">Non Aktif</option>
                         </select>
                     </div>
                 </div>

             </div>
         </div>

         <div class="modal-footer">
             <button type="submit" class="btn btn-success">
                 <i class="fas fa-save"></i> Simpan
             </button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">
                 Batal
             </button>
         </div>

     </div>
 </form>