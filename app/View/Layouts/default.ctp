<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Testing Centre Cover Letter Manager');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        //echo $this->Html->css('cake.generic') . "\n"; 
        echo $this->Html->css('bootstrap') . "\n";

        echo $this->Html->script('jquery.min') . "\n";
        echo $this->Html->script('bootstrap.min') . "\n";
        echo $this->Html->script('bootstrap.file-input') . "\n";


        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
<body>

<div class="navbar navbar-default">

    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <?php if ($logged_in): ?>  
            <div class ="col-md-offset-3">
                <ul class="nav navbar-nav">
                    <?php if ($current_user['user_role'] == 'professor'): ?>  
                        <li><?php echo $this->Html->link('Cover letters', array('controller' => 'coverletters', 'action' => 'index')) ?></li>
                        <li><?php echo $this->Html->link('Add cover letter', array('controller' => 'coverletters', 'action' => 'add')) ?> </li>
                    <?php else: ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')) ?></li>             
                                <li><?php echo $this->Html->link('Add new user', array('controller' => 'users', 'action' => 'add')) ?></li>   
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cover Letters <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><?php echo $this->Html->link('All Cover letters', array('controller' => 'coverletters', 'action' => 'index')) ?></li> 
                                <li><?php echo $this->Html->link('Submitted Cover letters', array('controller' => 'coverletters', 'action' => 'index', 'submitted')) ?></li>            
                                <li><?php echo $this->Html->link('Approved Cover letters', array('controller' => 'coverletters', 'action' => 'index', 'approved')) ?></li>
                                <li><?php echo $this->Html->link('Rejected Cover letters', array('controller' => 'coverletters', 'action' => 'index', 'rejected')) ?></li>
                                <li><?php echo $this->Html->link('Completed Cover letters', array('controller' => 'coverletters', 'action' => 'index', 'completed')) ?></li>
                            </ul>
                        </li>

                        <li><?php echo $this->Html->link('To be completed today', array('controller' => 'coverletters', 'action' => 'index', 'today')) ?></li>
                        <li><span class="badge"><?php echo $schedulled_coverletters; ?></span></li>

                    <?php endif; ?>

                </ul>
            </div>
            <ul class="nav navbar-nav navbar-right">

                <div class="navbar-header">
                    <div class="navbar-brand">
                        Welcome <?php echo $current_user['full_name']; ?>
                    </div>
                </div>
                <li>
                    <?php echo $this->Html->link('logout', array('controller' => 'users', 'action' => 'logout')); ?>
                </li>
            </ul>    
        <?php else: ?>
            <ul class="nav navbar-nav navbar-right">

                <div class="navbar-header">
                    <div class="navbar-brand">
                        <?php echo $cakeDescription; ?>
                    </div>
                </div>
                <li>
                    <?php echo $this->Html->link('login', array('controller' => 'users', 'action' => 'login')); ?>   
                </li>
            </ul>    
        <?php endif; ?>
        </li>
        </ul>
    </div>
</div>   

    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>

        </div>
    </div>

    </body>
</html>
