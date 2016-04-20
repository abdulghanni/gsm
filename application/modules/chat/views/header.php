
            <div class="drop-down-wrapper ps-container">
              <ul>
              <?php if($unread_all>0){
                      foreach($messages as $m): ?>
                <li class="unread">
                  <a href="#" id="<?=$m->id?>" class="message-list">
                    <div class="clearfix">
                      <div class="thread-image">
                        <?php 
                          $ph = getValue('photo','users', array('id'=>'where/'.$m->sender_id));//print_ag($ph);
                          $photo_link = base_url().'uploads/'.$m->sender_id.'/'.$ph;
                          $file_headers = @get_headers($photo_link);
                          $photo_unread_msg = ($file_headers[0] != 'HTTP/1.1 404 Not Found' && !empty($ph)) ? $photo_link : assets_url('assets/images/no-image-mid.png');
                        ?>
                        <img height="50px" width="50px" src="<?=$photo_unread_msg?>" alt="">
                      </div>
                      <div class="thread-content">
                        <span class="author"><?=getName($m->sender_id)?></span>
                        <span class="preview"><?= word_limiter($m->message, 30)?></span>
                        <span class="time"> <?= timeago($m->sent_on)?></span>
                      </div>
                    </div>
                  </a>
                </li>
              <?php endforeach;}else{
              echo "<span>Tidak ada pesan baru</span>";
              }?>
              </ul>
            </div>