{#extends file='layout-with-cart.tpl'#}
{#block name='head'#}
{#call_webservice path="details/isoform" data=["query1"=>$isoform_feature_id] assign='data'#}

<!--[if lt IE 9]><script type="text/javascript" src="http://canvasxpress.org/js/flashcanvas.js"></script><![endif]-->
<script type="text/javascript" src="http://canvasxpress.org/js/canvasXpress.min.js"></script>
<!-- use chrome frame if installed and user is using IE -->
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<script type="text/javascript">
    var feature_id = '{#$data.isoform.feature_id#}';

    $(document).ready(function() {
        $('.tabs').tabs();

        $.ajax('{#$ServicePath#}/graphs/genome/isoform/' + feature_id, {
            success: function(val) {
                canvas = $('#canvas_{#$data.isoform.uniquename|clean_id#}');
                canvas.attr('width', canvas.parent().width() - 8);
                if (val.tracks.length == 0)
                    return;
                new CanvasXpress(
                "canvas_{#$data.isoform.uniquename|clean_id#}",
                {
                    "tracks": val.tracks
                },
                {
                    graphType: 'Genome',
                    useFlashIE: true,
                    backgroundType: 'gradient',
                    backgroundGradient1Color: 'rgb(0,183,217)',
                    backgroundGradient2Color: 'rgb(4,112,174)',
                    oddColor: 'rgb(220,220,220)',
                    evenColor: 'rgb(250,250,250)',
                    missingDataColor: 'rgb(220,220,220)',
                    setMin: val.min,
                    setMax: val.max
                }
            );
            }
        });
        $('form.blast').submit(function(event) {
            queryInput = $(this).find('.query');
            query = $(queryInput.data('ref')).html();
            queryInput.val(query);
        });
        
        $('.contains-tooltip').tooltip({
            items: ".has-tooltip",
            open: function(event, ui) {
                /*ui.tooltip.offset({
                top: event.pageY, 
                left: event.pageX
            });*/
                ui.tooltip.css("max-width", "600px");
            },
            content: function() {
                var element = $(this);
                var tooltip = $("<table/>");
                console.log(this.attributes);
                
                $.each(this.attributes, function(key,attr) {
                    if (attr.name.substr(0,5)=='data-'){
                        var splitAt = attr.nodeValue.indexOf('|');
                        var name = attr.nodeValue.substr(0,splitAt);
                        var value = attr.nodeValue.substr(splitAt+1);
                        if (value==='')
                            return; //skip empty values
                        $("<tr><td>" + name + "</td><td>" + value + "</td></tr>").appendTo(tooltip);
                    }
                });
                tooltip.foundation();
                return tooltip;
            }
        });
    });

    


    
</script>
<script type="text/javascript" src="{#$AppPath#}/js/feature/barplot.js"></script>
{#/block#}
{#block name='body'#}


<div class="row">
    <script type="text/javascript">addNavAnchor('isoform-overview','Isoform Overwiev');</script>
    <div class="large-12 columns panel" id="description">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="left">{#$data.isoform.name#}</h1>
                <div class="right"><span class="button" onclick="javascript:cart.addItem({#$data.isoform.feature_id#});"> add to cart -> </span></div>
            </div>
        </div>
        <table style="width:100%">
            <tbody>
                <tr><td>Last modified</td><td>{#$data.isoform.timelastmodified#}</td></tr>
                <tr><td>Corresponding unigene</td><td><a href="{#$AppPath#}/details/byId/{#$data.isoform.unigene.feature_id#}">{#$data.isoform.unigene.uniquename#}</a></td></tr>
                <tr><td>Release</td><td>{#$data.isoform.import#}</td></tr>
                <tr><td>Organism</td><td>{#$data.isoform.organism_name#}</td></tr>
            </tbody>
        </table>
    </div>
</div>
{#include file="display-components/synonym.tpl" feature=$data.isoform #}
<script type="text/javascript">addNavAnchor('sequence-annotation','Sequence Annotation');</script>
<div class="row">
    <div class="large-12 columns">
        <h4>Sequence Annotation</h4>
    </div>
    <div class="large-12 columns panel">
        <canvas id="canvas_{#$data.isoform.uniquename|clean_id#}" width="600"></canvas>
        <div style="clear:both; height:1px; overflow:hidden">&nbsp;</div>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <div class="row">
            <div class="large-6 columns">
                <h4>Sequence</h4>
            </div>
        </div>
    </div>
    <div class="large-12 columns panel">
        <textarea style="height:100px;" id="sequence-{#$data.isoform.uniquename|clean_id#}">{#$data.isoform.residues#}</textarea>
    </div>
</div>

{#if isset($data.isoform.description) #}
    <div class="row">
        <div class="large-12 columns panel">
            <h4>Descriptions:</h4>
            {#foreach $data.isoform.description as $description#}
                <h5> {#$description.value#}</h5>
            {#/foreach#}

        </div>
    </div>
{#/if#}

{#include file="display-components/dbxref.tpl" feature=$data.isoform #}

{#include file="display-components/mapman.tpl" feature=$data.isoform #}

{#include file="display-components/publication.tpl" feature=$data.isoform #}


{#include file="display-components/repeatmasker.tpl" feature=$data.isoform #}


{#include file="display-components/predpeps.tpl" feature=$data.isoform #}

<script type="text/javascript">addNavAnchor('plot','Plot Expression Data');</script>
{#include file="display-components/barplot.tpl"#}
{#/block#}