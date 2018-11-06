<article id="politica-privacidad" class="wrapper-page less-padding">
    <style>
     .titulo-importante {
        color: #00acec;
        font-size: 200%;
        margin: 2rem;
        line-height: 120%;
        position: relative;
     }

    .titulo-importante>span {
        background-color: #fff;
        position: relative;
        z-index: 1;
        padding-right: 1rem;
    }
    
    .titulo-importante:after {
         content: '';
         position: absolute;
         right: 0;
         width: 100%;
         top: 50%;
         transform: translateY(-50%);
         height: 1px;
         background-color: #00acec;
     }

     .contenido {
        padding: 1rem 2rem;
        background-color: #F2F2F2;
        color: #666;
     }

    .contenido h2 {
        font-weight: 700!important;
    }

    .contenido strong {
        font-weight: 700;
        color: #00acec;
    }

    .contenido em {
        font-weight: 700;
    }

    @media (max-width: 480px) {

        .titulo-importante {
            font-size: 150%;
        }

        .titulo-importante>span {
            padding-right: 0;
        }
    
        .titulo-importante:after {
            content: none;
        }
    }

    </style>
	<div class="container">
	    
	    <?php showPageHtml('2', true); ?>

    </div>
</article>