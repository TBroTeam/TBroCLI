<?php /* Smarty version Smarty-3.1.13, created on 2013-03-19 14:05:35
         compiled from "/home/s202139/git/httpdocs/smarty/templates/display-unigene.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3222948515140a1c3e86c70-52544708%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8769c2c0ac713dc3c311b1d45ceb9324386ee356' => 
    array (
      0 => '/home/s202139/git/httpdocs/smarty/templates/display-unigene.tpl',
      1 => 1363274328,
      2 => 'file',
    ),
    '1bfb3dec557c7a9258f8cf6f645e611f160e265d' => 
    array (
      0 => '/home/s202139/git/httpdocs/smarty/templates/layout.tpl',
      1 => 1363697440,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3222948515140a1c3e86c70-52544708',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5140a1c4030793_66894477',
  'variables' => 
  array (
    'AppPath' => 0,
    'ServicePath' => 0,
    'kickoff_cart' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5140a1c4030793_66894477')) {function content_5140a1c4030793_66894477($_smarty_tpl) {?><?php if (!is_callable('smarty_function_call_webservice')) include '/home/s202139/git/httpdocs/client/../smarty/plugins/function.call_webservice.php';
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title>Transcript Browser - dionaea muscipula</title>

        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/css/normalize.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/css/foundation.css" />
        <!--link type="text/css" href="http://code.jquery.com/ui/1.10.1/themes/base/minified/jquery-ui.min.css" rel="Stylesheet" /-->    
        <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/css/custom-theme/jquery-ui-1.10.2.custom.css" rel="Stylesheet" />    

        <!--script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script-->
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/js/jquery-1.9.1.min.js"></script>
        <!--script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script-->
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/js/jquery-ui-1.10.2.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/js/vendor/custom.modernizr.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/js/foundation.min.js"></script>        
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/js/jquery.webStorage.min.js"></script>        
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/js/cart.js"></script>        


        <script type="text/javascript">
            $(document).ready(function() {
                $(document).foundation();
                $("#search_unigene").autocomplete({
                    position: {
                        my: "right top", at: "right bottom"
                    },
                    source: function(request, response) {
                        $.ajax({
                            url: "<?php echo $_smarty_tpl->tpl_vars['ServicePath']->value;?>
/listing/unigenes/" + request.term,
                            dataType: "json",
                            success: function(data) {
                                response(data.results);
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {
                        window.location.href = '<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/unigene-details/' + ui.item.value;
                    }
                });
                $('#search_unigene').keydown(function(event) {
                    //Enter
                    if (event.which == 13) {
                        event.preventDefault();
                        $.ajax({
                            url: "<?php echo $_smarty_tpl->tpl_vars['ServicePath']->value;?>
/listing/unigenes/" + $(this).val(),
                            dataType: "json",
                            success: function(data) {
                                if (data.results.length == 1) {
                                    window.location.href = '<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/unigene-details/' + data.results[0];
                                }
                            }
                        });
                    }
                });
                $("#cart-group-all").accordion({
                    collapsible: true,
                    heightStyle: "content"
                });
                <?php echo smarty_function_call_webservice(array('path'=>"cart/sync",'data'=>array(),'assign'=>'kickoff_cart'),$_smarty_tpl);?>


                cart.rebuildDOM(<?php echo json_encode($_smarty_tpl->tpl_vars['kickoff_cart']->value['cart']);?>
);
                setInterval(cart.checkRegularly, 15000);
            });</script>

        <script type="text/javascript">
            function buildTestCart() {
                cart.resetCart({sync: true});
                cart.addGroup();
                cart.addItemToAll({uniquename: '1.01_comp231081_c0_seq1'});
                cart.addItemToAll({uniquename: '1.01_comp231081_c0_seq1'});
                cart.addItemToAll({uniquename: '1.01_comp231123_c0_seq1'});
                cart.addItemToAll({uniquename: '1.01_comp2381_c0_seq1'});
                cart.addGroup();
                cart.renameGroup('group 1', 'myGroup!');
                cart.addItemToGroup({uniquename: '1.01_comp2381_c0_seq1'}, 'myGroup!');
                cart.addItemToGroup({uniquename: '1.01_comp231123_c0_seq1'}, 'myGroup!');
                cart.removeItemFromAll({uniquename: '1.01_comp2381_c0_seq1'});
            }

            $(document).ready(function() {
                //buildTestCart();
            });
        </script>
        <style>
            .ui-accordion .ui-accordion-header {
                margin-bottom:0px;
            }
            .ui-accordion .ui-accordion-content {
                padding: 0.5em 1em;
            }
            .beingDragged {
                list-style: none;
            }
        </style>

        
<?php echo smarty_function_call_webservice(array('path'=>"details/unigene",'data'=>array("query1"=>$_smarty_tpl->tpl_vars['unigene_uniquename']->value),'assign'=>'data'),$_smarty_tpl);?>



    </head>
    <body>
        <div class="fixed">
            <nav class="top-bar" id="top">
                <ul class="title-area">
                    <li class="name">
                        <h1><a>Transcript Browser: dionaea muscipula</a></h1>
                    </li>
                </ul>
                <section class="top-bar-section">
                    <ul class="right">
                        <li class="divider"></li>
                        <li><a>search for unigene:</a></li>
                        <li><input type="text" id="search_unigene" data-tooltip class="has-tip" title="try 1.01_comp231081_c0 or 1.01_comp214244_c0"/></li>
                        <li>&nbsp;</li> 
                    </ul>
                </section>
            </nav>
        </div>
        <div class="row">
            <div class="large-9 columns">
                

<div class="row">
    <div class="large-12 columns panel">
        <h1><?php echo $_smarty_tpl->tpl_vars['data']->value['unigene']['uniquename'];?>
</h1>
        <h5>last modified: <?php echo $_smarty_tpl->tpl_vars['data']->value['unigene']['timelastmodified'];?>
</h5>
    </div>
</div>

<div class="row">        
    <div class="large-12 columns panel">
        <p>known isoforms:</p>
        <table>
            <tbody>
                <?php  $_smarty_tpl->tpl_vars['isoform_uniquename'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['isoform_uniquename']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['unigene']['isoforms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['isoform_uniquename']->key => $_smarty_tpl->tpl_vars['isoform_uniquename']->value){
$_smarty_tpl->tpl_vars['isoform_uniquename']->_loop = true;
?>
                    <tr>
                        <td><a href='<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/isoform-details/<?php echo $_smarty_tpl->tpl_vars['isoform_uniquename']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['isoform_uniquename']->value;?>
</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


            </div>
            <div class="large-3 columns" >
                <div class="row large-3 columns" style="position:fixed;top:45px;bottom:0;overflow-x:hidden;overflow-y:auto;">

                    <div class=" panel large-12 columns">
                        <h4>Cart</h4>
                        <div id="cart-group-all" class='ui_accordion ui_collapsible'>
                            <div class="large-12 columns"><div class="left">all</div><div class="right"><img src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/img/mimiGlyphs/23.png"/></div></div>
                            <ul class="large-12 columns">
                            </ul>
                        </div>
                        <div>
                            <a id="cart-add-group" class="button secondary right">add new cart</a>
                            <div style="clear:both">&nbsp;</div>
                        </div>
                        <div id="cart-groups">

                        </div>
                    </div>
                    <div style="display: none">
                        <div id="cart-group-dummy"> 
                            <div class='cart-group' data-group="#groupname#">
                                <div class="large-12 columns">
                                    <div class="groupname left">#groupname#</div>
                                    <div class="right">
                                        <img class="cart-button-rename" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/img/mimiGlyphs/39.png"/>
                                        <img class="cart-button-delete" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/img/mimiGlyphs/51.png"/>
                                        <img class="cart-button-execute" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/img/mimiGlyphs/23.png"/>
                                    </div>
                                </div>
                                <ul class="cart-target large-12 columns">
                                    <li class="placeholder">drag your items here</li>
                                </ul>
                            </div>
                        </div>

                        <ul id="cart-item-dummy"> 
                            <li data-uniquename="#uniquename#" style="clear:both" class="large-12 cart-item">
                                <div class="left">#uniquename#</div>
                                <div class="right">
                                    <img class="cart-button-delete" src="<?php echo $_smarty_tpl->tpl_vars['AppPath']->value;?>
/img/mimiGlyphs/51.png"/>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>&nbsp;</div>
            </div>
        </div>
    </body>
</html>

<?php }} ?>