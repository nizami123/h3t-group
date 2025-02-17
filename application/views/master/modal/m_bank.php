                <!-- Modal Edit Data Bank -->
                <div class="modal fade bd-example-modal-xl" id="EditBank" tabindex="-1" role="dialog" aria-labelledby="EditBank" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content dark-sign-up">
                      <div class="modal-body social-profile text-start">
                        <div class="modal-toggle-wrapper">
                            <div class="modal-header mb-4">
                                <h3>Edit Master Data Bank</h3>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation">
                                  <!-- Bank -->
                                  <div class="col-md-4 position-relative"> 
                                      <label class="form-label" for="bank">Bank</label>
                                      <select class="form-select" id="e_nama_bank" name="e_nama_bank" required="">
                                          <option selected="" disabled="" value="0">Pilih Bank</option>
                                      </select>
                                  </div>
                                  <!-- Nomor Rekening -->
                                  <div class="col-md-4 position-relative"> 
                                      <label class="form-label" for="no_rek">Nomor Rekening</label>
                                      <input class="form-control" id="e_no_rek" name="e_no_rek" type="number" aria-label="no_rek" required>
                                      <input class="form-control" id="h_no_rek" name="h_no_rek" type="hidden" aria-label="no_rek" required>
                                  </div>
                                  <!-- Nama Rekening -->
                                  <div class="col-md-4 position-relative"> 
                                      <label class="form-label" for="nama_rek">Nama Rekening</label>
                                      <input class="form-control" id="e_nama_rek" name="e_nama_rek" type="text" aria-label="nama_rek" required>
                                  </div>
                                  <!-- Submit Bank -->
                                  <div class="col-md-12 position-relative">
                                      <button class="btn btn-primary" id="edit" type="button">Edit Bank</button>
                                  </div>
                              </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>