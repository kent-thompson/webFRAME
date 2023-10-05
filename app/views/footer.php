</div>
<div class="footer">
    <!-- <script src="../res/js/jquery-3.3.1.min.js"></script> -->
    <link rel="stylesheet" href="../res/css/flexslider.css">
    <script src="../res/js/jquery.flexslider-min.js"></script>
    <script src="../res/js/jquery.easing.1.3.js"></script>    
    <script src="../res/js/ktc.js"></script>
    <script src="../res/js/stickyfloat.min.js"></script>
    <hr>
    <span><a href="https://validator.w3.org/check?uri=referer"><img class="footerImg" src="../res/img/html5.png" alt="Valid HTML 5"></a></span>
    <span class="smalltxt">Copyright &copy; Kent Thompson Consulting.&nbsp;	
        <?php
            $execEndTime = microtime(true);
            $seconds = round( $execEndTime - $GLOBALS['execStartTime'], 4);
            echo "Page rendered in $seconds seconds." 
        ?>
    </span>
</div>
</body>
</html>

