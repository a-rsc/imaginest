<?php

session_start();

require_once(dirname(__DIR__, 1) . '/php/config/env.php');

?>
<!DOCTYPE html>
<html lang="<?php echo CONFIG['APP_LOCALE']; ?>">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Imaginest is a web application to share and enjoy images" />
    <meta name="author" content="Inmanol Garcia, Alvaro Rodriguez" />
    <title><?php echo CONFIG['APP_NAME']; ?></title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link href="css/imaginest.css" rel="stylesheet" />
</head>
<body class="bodyAuthentication">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-primary" href="<?php echo CONFIG['URL'] . "/index.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>">
                <h1><i class="fas fa-globe"></i> <?php echo CONFIG['APP_NAME']; ?></h1>
            </a>
        </div>
    </nav>
    <div id="layoutPrivacyTerms">
        <div id="layoutPrivacyTerms_content">
            <main">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-lg border-lg">
                                <div class="card-body">
                                    <h1 class="text-center">Privacy Policy</h1>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas repellat nostrum maiores atque id sit neque quia voluptas modi assumenda explicabo saepe rem laborum culpa numquam temporibus ea ipsa, quam perspiciatis est! Corporis nostrum commodi cupiditate sunt ullam architecto nisi deserunt voluptatem, porro, exercitationem numquam eveniet assumenda vitae nam ratione consectetur dolorem sed sapiente? Beatae quis vero, quod adipisci, ducimus praesentium consequuntur totam, tenetur error sunt dolore suscipit quasi cum pariatur esse animi! Hic, nemo eveniet molestias, consectetur id distinctio in est cum magni ea adipisci rerum. Veniam repellendus assumenda cupiditate ullam id aut, pariatur ad nihil laboriosam maxime aliquid.</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic iste repellat, ea assumenda sapiente alias reprehenderit quam, quae rerum qui labore quisquam delectus architecto obcaecati similique. Placeat, sapiente magnam ut fugit qui numquam dolor sunt vitae ipsum laboriosam neque impedit fugiat reiciendis adipisci dolores delectus beatae iusto. Ad veniam unde iure error voluptatibus alias excepturi totam debitis. Et reprehenderit pariatur vel inventore necessitatibus soluta dolore enim commodi libero, nobis autem obcaecati vitae ipsa dignissimos accusantium quis, exercitationem saepe a. Vel fugit unde, suscipit maxime recusandae magni aperiam at labore voluptatem vero magnam quaerat sint dicta quo dolorum ipsam enim ea. Debitis, nisi. Dolore aliquam enim doloribus totam ut, recusandae debitis ea nihil minima reprehenderit voluptatem cupiditate nostrum libero, obcaecati distinctio adipisci impedit numquam iure et maxime tenetur. Error numquam eos ducimus. Qui consequatur, aperiam atque blanditiis modi sint a rerum quam, corrupti ratione ipsam, officiis velit praesentium laudantium? Fuga maiores quae perferendis mollitia, ut fugit at dolor provident fugiat rerum nemo tenetur possimus voluptatum culpa facilis nisi sit praesentium consequuntur obcaecati, magni explicabo. Laudantium pariatur nihil ad quibusdam repudiandae commodi alias harum tenetur, fugit beatae ab tempora veritatis voluptatum? Corrupti eius magnam facere optio sunt nemo voluptatem aliquid vel id!</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur quidem voluptates consectetur at numquam voluptate dolorem nisi obcaecati asperiores, necessitatibus odit sed omnis quisquam modi libero maiores in, accusamus veniam laborum repellendus? Eaque, cum! Architecto, nostrum dolores. Maiores ducimus, non officia id molestias voluptate odit doloremque. Ab expedita possimus cumque atque ratione esse, sint officiis assumenda quasi quisquam impedit praesentium voluptatem alias at. Voluptates hic illum, eaque in obcaecati quos. Quam libero, iusto at velit veniam maiores unde, praesentium eaque sed quasi rerum eum, qui debitis assumenda dignissimos temporibus architecto alias necessitatibus modi quisquam sunt autem odit sequi dolorem? Obcaecati eveniet consequuntur natus molestiae tenetur ipsa cum eaque nemo hic explicabo odio iste, quaerat quisquam quam facilis necessitatibus vitae. Distinctio, laboriosam autem iusto nulla minima natus expedita quis explicabo sit nesciunt a iure illo modi veritatis excepturi impedit illum. Quidem quia nobis officiis, ducimus corrupti placeat dolore. Error delectus placeat consequuntur obcaecati suscipit voluptatum odit quo molestias debitis similique minima iure voluptas fuga, totam iste nam doloribus enim sed ab ullam tempora. Quisquam ea amet ab, exercitationem maiores expedita ut culpa, molestiae qui numquam in quis odio dolore excepturi similique unde accusamus repellendus veniam necessitatibus magnam ratione. Voluptas qui, aliquid rem in ratione illum numquam iure consectetur atque tempore impedit accusantium accusamus ea quis et autem neque nesciunt facilis. A ex culpa pariatur libero temporibus amet quo, at voluptatibus dolor praesentium veritatis? Delectus accusamus, cum, nesciunt hic nulla architecto aperiam ipsa minus voluptatibus aspernatur quisquam quibusdam explicabo, officia nobis ex.</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas repellat nostrum maiores atque id sit neque quia voluptas modi assumenda explicabo saepe rem laborum culpa numquam temporibus ea ipsa, quam perspiciatis est! Corporis nostrum commodi cupiditate sunt ullam architecto nisi deserunt voluptatem, porro, exercitationem numquam eveniet assumenda vitae nam ratione consectetur dolorem sed sapiente? Beatae quis vero, quod adipisci, ducimus praesentium consequuntur totam, tenetur error sunt dolore suscipit quasi cum pariatur esse animi! Hic, nemo eveniet molestias, consectetur id distinctio in est cum magni ea adipisci rerum. Veniam repellendus assumenda cupiditate ullam id aut, pariatur ad nihil laboriosam maxime aliquid.</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic iste repellat, ea assumenda sapiente alias reprehenderit quam, quae rerum qui labore quisquam delectus architecto obcaecati similique. Placeat, sapiente magnam ut fugit qui numquam dolor sunt vitae ipsum laboriosam neque impedit fugiat reiciendis adipisci dolores delectus beatae iusto. Ad veniam unde iure error voluptatibus alias excepturi totam debitis. Et reprehenderit pariatur vel inventore necessitatibus soluta dolore enim commodi libero, nobis autem obcaecati vitae ipsa dignissimos accusantium quis, exercitationem saepe a. Vel fugit unde, suscipit maxime recusandae magni aperiam at labore voluptatem vero magnam quaerat sint dicta quo dolorum ipsam enim ea. Debitis, nisi. Dolore aliquam enim doloribus totam ut, recusandae debitis ea nihil minima reprehenderit voluptatem cupiditate nostrum libero, obcaecati distinctio adipisci impedit numquam iure et maxime tenetur. Error numquam eos ducimus. Qui consequatur, aperiam atque blanditiis modi sint a rerum quam, corrupti ratione ipsam, officiis velit praesentium laudantium? Fuga maiores quae perferendis mollitia, ut fugit at dolor provident fugiat rerum nemo tenetur possimus voluptatum culpa facilis nisi sit praesentium consequuntur obcaecati, magni explicabo. Laudantium pariatur nihil ad quibusdam repudiandae commodi alias harum tenetur, fugit beatae ab tempora veritatis voluptatum? Corrupti eius magnam facere optio sunt nemo voluptatem aliquid vel id!</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur quidem voluptates consectetur at numquam voluptate dolorem nisi obcaecati asperiores, necessitatibus odit sed omnis quisquam modi libero maiores in, accusamus veniam laborum repellendus? Eaque, cum! Architecto, nostrum dolores. Maiores ducimus, non officia id molestias voluptate odit doloremque. Ab expedita possimus cumque atque ratione esse, sint officiis assumenda quasi quisquam impedit praesentium voluptatem alias at. Voluptates hic illum, eaque in obcaecati quos. Quam libero, iusto at velit veniam maiores unde, praesentium eaque sed quasi rerum eum, qui debitis assumenda dignissimos temporibus architecto alias necessitatibus modi quisquam sunt autem odit sequi dolorem? Obcaecati eveniet consequuntur natus molestiae tenetur ipsa cum eaque nemo hic explicabo odio iste, quaerat quisquam quam facilis necessitatibus vitae. Distinctio, laboriosam autem iusto nulla minima natus expedita quis explicabo sit nesciunt a iure illo modi veritatis excepturi impedit illum. Quidem quia nobis officiis, ducimus corrupti placeat dolore. Error delectus placeat consequuntur obcaecati suscipit voluptatum odit quo molestias debitis similique minima iure voluptas fuga, totam iste nam doloribus enim sed ab ullam tempora. Quisquam ea amet ab, exercitationem maiores expedita ut culpa, molestiae qui numquam in quis odio dolore excepturi similique unde accusamus repellendus veniam necessitatibus magnam ratione. Voluptas qui, aliquid rem in ratione illum numquam iure consectetur atque tempore impedit accusantium accusamus ea quis et autem neque nesciunt facilis. A ex culpa pariatur libero temporibus amet quo, at voluptatibus dolor praesentium veritatis? Delectus accusamus, cum, nesciunt hic nulla architecto aperiam ipsa minus voluptatibus aspernatur quisquam quibusdam explicabo, officia nobis ex.</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas repellat nostrum maiores atque id sit neque quia voluptas modi assumenda explicabo saepe rem laborum culpa numquam temporibus ea ipsa, quam perspiciatis est! Corporis nostrum commodi cupiditate sunt ullam architecto nisi deserunt voluptatem, porro, exercitationem numquam eveniet assumenda vitae nam ratione consectetur dolorem sed sapiente? Beatae quis vero, quod adipisci, ducimus praesentium consequuntur totam, tenetur error sunt dolore suscipit quasi cum pariatur esse animi! Hic, nemo eveniet molestias, consectetur id distinctio in est cum magni ea adipisci rerum. Veniam repellendus assumenda cupiditate ullam id aut, pariatur ad nihil laboriosam maxime aliquid.</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic iste repellat, ea assumenda sapiente alias reprehenderit quam, quae rerum qui labore quisquam delectus architecto obcaecati similique. Placeat, sapiente magnam ut fugit qui numquam dolor sunt vitae ipsum laboriosam neque impedit fugiat reiciendis adipisci dolores delectus beatae iusto. Ad veniam unde iure error voluptatibus alias excepturi totam debitis. Et reprehenderit pariatur vel inventore necessitatibus soluta dolore enim commodi libero, nobis autem obcaecati vitae ipsa dignissimos accusantium quis, exercitationem saepe a. Vel fugit unde, suscipit maxime recusandae magni aperiam at labore voluptatem vero magnam quaerat sint dicta quo dolorum ipsam enim ea. Debitis, nisi. Dolore aliquam enim doloribus totam ut, recusandae debitis ea nihil minima reprehenderit voluptatem cupiditate nostrum libero, obcaecati distinctio adipisci impedit numquam iure et maxime tenetur. Error numquam eos ducimus. Qui consequatur, aperiam atque blanditiis modi sint a rerum quam, corrupti ratione ipsam, officiis velit praesentium laudantium? Fuga maiores quae perferendis mollitia, ut fugit at dolor provident fugiat rerum nemo tenetur possimus voluptatum culpa facilis nisi sit praesentium consequuntur obcaecati, magni explicabo. Laudantium pariatur nihil ad quibusdam repudiandae commodi alias harum tenetur, fugit beatae ab tempora veritatis voluptatum? Corrupti eius magnam facere optio sunt nemo voluptatem aliquid vel id!</p>
                                    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, facere.</h2>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur quidem voluptates consectetur at numquam voluptate dolorem nisi obcaecati asperiores, necessitatibus odit sed omnis quisquam modi libero maiores in, accusamus veniam laborum repellendus? Eaque, cum! Architecto, nostrum dolores. Maiores ducimus, non officia id molestias voluptate odit doloremque. Ab expedita possimus cumque atque ratione esse, sint officiis assumenda quasi quisquam impedit praesentium voluptatem alias at. Voluptates hic illum, eaque in obcaecati quos. Quam libero, iusto at velit veniam maiores unde, praesentium eaque sed quasi rerum eum, qui debitis assumenda dignissimos temporibus architecto alias necessitatibus modi quisquam sunt autem odit sequi dolorem? Obcaecati eveniet consequuntur natus molestiae tenetur ipsa cum eaque nemo hic explicabo odio iste, quaerat quisquam quam facilis necessitatibus vitae. Distinctio, laboriosam autem iusto nulla minima natus expedita quis explicabo sit nesciunt a iure illo modi veritatis excepturi impedit illum. Quidem quia nobis officiis, ducimus corrupti placeat dolore. Error delectus placeat consequuntur obcaecati suscipit voluptatum odit quo molestias debitis similique minima iure voluptas fuga, totam iste nam doloribus enim sed ab ullam tempora. Quisquam ea amet ab, exercitationem maiores expedita ut culpa, molestiae qui numquam in quis odio dolore excepturi similique unde accusamus repellendus veniam necessitatibus magnam ratione. Voluptas qui, aliquid rem in ratione illum numquam iure consectetur atque tempore impedit accusantium accusamus ea quis et autem neque nesciunt facilis. A ex culpa pariatur libero temporibus amet quo, at voluptatibus dolor praesentium veritatis? Delectus accusamus, cum, nesciunt hic nulla architecto aperiam ipsa minus voluptatibus aspernatur quisquam quibusdam explicabo, officia nobis ex.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutPrivacyTerms_footer">
            <footer class="footer mt-auto footer-dark">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 small text-center text-md-left">All rights reserved &copy; <a href="<?php echo CONFIG['URL'] . "/index.php"; ?>" title="<?php echo CONFIG['APP_NAME']; ?>"><?php echo CONFIG['APP_NAME']; ?></a> &middot; <?php echo date("Y"); ?></div>
                        <div class="col-md-6 small text-center text-md-right">
                            <a href="<?php echo CONFIG['URL'] . "/privacy.php"; ?>" title="Privacy Policy">Privacy Policy</a>
                            &middot;
                            <a href="<?php echo CONFIG['URL'] . "/terms.php"; ?>" title="Terms & Conditions">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Return to Top -->
    <div id="return-to-top">
        <i class="fas fa-chevron-circle-up"></i>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/general.js"></script>
</body>
</html>
