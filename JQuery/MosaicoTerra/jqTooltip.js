/**

    Project: Tooltip de imagens

    Version: 1.0.1
    Date: 12/07/2010

    Author: Rogério Avelino da Silva 

*/

jQuery.fn.extend({
    jqTooltip: function(jsonOptions){

        var defaults = {
            bordaDiv: "5px solid #000",
            espacamentoDiv: "5px",
            fundoDiv: "#fff",
            bordaImg: "1px solid #000",
            espacamentoImg: "2px",
        }

        var options = jQuery.extend(defaults, jsonOptions);

        var jsonCSS = {};

        var obj = $(this);                

        obj.find("img").each( function(){
            $(this).mouseover(
                function(e){
                    var imagem = $(this);

                    var pathImagem = imagem.attr("src");

                    var w = e.pageX - imagem.outerWidth(true);
                    var h = e.pageY - imagem.outerHeight(true);

                    jsonCSS.top = h + "px";
                    jsonCSS.left = w + "px"
                    jsonCSS.border = options.bordaDiv;
                    jsonCSS.padding = options.espacamentoDiv;
                    jsonCSS.background = options.fundoDiv;
                    jsonCSS.position = "absolute";                            

                    var link = imagem.attr("link");
                    if ( typeof link != "undefined" ){
                        jsonCSS.cursor = "pointer";
                    }

                    criaDiv(pathImagem,imagem.attr("title"),imagem.attr("alt"));
                    $("#jqTooltipDDiv")
                        .css(jsonCSS).fadeIn(1200,function(){
                            if ( typeof link != "undefined" ){
                                $("#jqTooltipDDiv").click(function(){
                                    window.open(link);
                                });
                            }
                        })
                        .mouseout(
                            function(){
                                $(this).remove();
                            }
                        );
                }
            );
        } );

        function criaDiv(pathImagem,titulo,descricao){
            var dImg = "<img style='border:" + options.bordaImg + ";margin:" + options.espacamentoDiv + "' src='" + pathImagem + "' />";
            var dDivTitulo = "<div id='jqTooltipDDivTitulo' style='font-size:12px;font-weight:bold;text-align:center;'>" + titulo + "</div>";
            var dDivSubTitulo = "<div id='jqTooltipDDivDescricao' style='font-size:12px'>" + descricao + "</div>";
            var dDiv = "<div id='jqTooltipDDiv' style='display:none;text-align:center;'>" + dImg + dDivTitulo + dDivSubTitulo + "</div>";
            $("body").append(dDiv);
        }

    }
});
