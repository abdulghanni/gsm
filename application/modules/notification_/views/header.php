<div class="drop-down-wrapper ps-container">
              <div class="list-group no-margin">
                <?php foreach($notification->result() as $n):
                  $photo_link = getValue('photo', 'users', array('id'=>'where/'.$n->sender_id));
                  $photo_link = base_url().'uploads/'.$n->sender_id.'/'.$photo_link;
                  $file_headers = @get_headers($photo_link);
                  $sender_photo = ($file_headers[0] != 'HTTP/1.1 404 Not Found') ? $photo_link : assets_url('assets/images/no-image-mid.png');
                ?>
                <a class="media list-group-item notif-list" href="#" id="<?=$n->id?>">
                  <img class="img-circle" height="40px" width="40px" alt="..." src="<?=$sender_photo?>">
                  <span class="media-body block no-margin"> <?= $n->judul ?> 
                  <small class="block text-black">No: <?= $n->no?>, <?=getName($n->sender_id)?></small>
                  <small class="block text-grey"><?= timeago($n->sent_on)?></small> 
                  </span>
                </a>
              <?php endforeach; ?>
              </div>
            </div>