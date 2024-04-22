<?php
include 'DBconnection.php';
?>
<!-- Cards of twitter datas -->
<div class="swiper mySwiper">
    <h1 class="table-title">Twitter</h1>
    <div class="swiper-wrapper cardBox">
        <?php
        //show databse rows 
        $query = "SELECT DISTINCT * FROM twittdata  ORDER BY creation DESC LIMIT " . $GLOBALS['CARDS_TO_DISPLAY'];
        $result = mysqli_query($conn, $query);
        $resultCheck =  mysqli_num_rows($result);
        while ($rows = mysqli_fetch_assoc($result)) {
        ?>
            <div class="swiper-slide card">
                <div class="twitt-top-bar">
                    <div class="creation-date"><?php echo $rows['creation']; ?></div>
                    <?php if($rows['organization'] != ''){
                        ?>
                        <div class="org-div">  
                        <svg id="org-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297 297" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297">
                            <g>
                                <path d="M91.304,68.029c18.756,0,34.015-15.259,34.015-34.015S110.06,0,91.304,0S57.289,15.259,57.289,34.015   S72.548,68.029,91.304,68.029z" />
                                <path d="M229.66,68.029c18.756,0,34.015-15.259,34.015-34.015S248.416,0,229.66,0s-34.015,15.259-34.015,34.015   S210.904,68.029,229.66,68.029z" />
                                <path d="m228.04,82.5c-19.002,0-34.405,15.404-34.405,34.405v171.552c0,4.718 3.825,8.543 8.543,8.543h39.625c4.718,0 8.543-3.825 8.543-8.543v-81.409l11.582-31.749c0.342-0.938 0.517-1.93 0.517-2.928v-55.465c0.001-19.002-15.403-34.406-34.405-34.406z" />
                                <path d="m128.664,84.513l-.057-.019-9.708-2.979c-1.531-0.471-3.167,0.34-3.718,1.85l-20.414,56.011c-1.178,3.231-5.748,3.231-6.925,0l-20.415-56.011c-0.445-1.22-1.596-1.985-2.83-1.985-0.292,0-0.59,0.043-0.884,0.133l-9.7,2.976c-12.401,4.132-20.687,15.629-20.687,28.629v59.251c0,0.588 0.172,1.163 0.495,1.655l21.3,32.415v82.017c0,1.665 1.35,3.015 3.015,3.015h66.335c1.665,0 3.015-1.35 3.015-3.015v-82.016l21.301-32.415c0.323-0.492 0.495-1.067 0.495-1.655v-59.406c0-12.944-8.318-24.422-20.618-28.451z" />
                                <path d="m99.119,80.218c-0.786-0.856-1.935-1.287-3.097-1.287h-8.67c-1.162,0-2.311,0.431-3.098,1.287-1.217,1.326-1.393,3.241-0.53,4.738l4.635,6.987-2.17,18.302 4.272,11.365c0.417,1.143 2.033,1.143 2.45,0l4.272-11.365-2.17-18.302 4.634-6.987c0.866-1.497 0.689-3.412-0.528-4.738z" />
                            </g>
                        </svg>
                        <div class="org-popup-text"><?php echo $rows['organization']; ?></div>
                    </div>
                    <?php }?>
                </div>
                
                <div class="comment"><?php echo $rows['comment']; ?></div>
                <div class="link"><?php echo $rows['link']; ?></div>
                <div class="nickname"><a href="<?php echo  "https://twitter.com/MarkTabNet/status/" . $rows['ID'] ?>" target="_blank"><?php echo $rows['nickname']; ?></a></div>
                <a href="<?php echo $rows['imageurl'] ?>" target="_blank">
                    <div class="image"><img src="<?php echo $rows['imageurl'] ?>" alt="">
                        <div class="image-text"><?php echo $rows['imagetext']; ?></div>
                    </div>
                </a>

            </div>

        <?php
        }
        ?>

    </div>
    <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
    <div class="swiper-pagination"></div>
</div>