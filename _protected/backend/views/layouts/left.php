<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => 'User Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
							['label' => 'All Users', 'icon' => 'fa fa-file-code-o', 'url' => ['/user'],],
                            ['label' => 'Add New User', 'icon' => 'fa fa-dashboard', 'url' => ['/user/create'],],
                        ],
                    ],
					[   'label' => 'Global Settings',
                        'icon' => 'fa fa-cogs',
                        'url' => ['/global-setting/update?id=1'],
                        	
					], 
                    [
                        'label' => 'Menu Management',
                        'icon' => 'fa fa-bars ',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All Menus', 'icon' => 'fa fa-circle-o', 'url' => ['/parent-menu'],],
                            ['label' => 'Add New Menu', 'icon' => 'fa fa-plus', 'url' => ['/parent-menu/create'],],
						],	
					],	
                    [
                        'label' => 'Pages Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All Pages', 'icon' => 'fa fa-circle-o', 'url' => ['/pages'],],
                            ['label' => 'Add New Page', 'icon' => 'fa fa-plus', 'url' => ['/pages/create'],],
                        ],
                    ],					
					
                ],
				
            ]
        ) ?>

    </section>

</aside>
