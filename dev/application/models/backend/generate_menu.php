<?php
                $ListMenu = $this->generateMenu();
		createCache($ListMenu,"menu");
                //untuk footer
                $MenuFooterAA = $this->generateFooterAA();
                print_r($MenuFooterAA);
                die;
		createCache($MenuFooterAA,"menuFooterAA");
                $MenuFooterAB = $this->generateFooterAB();
		createCache($MenuFooterAB,"menuFooterAB");
                
                $MenuFooterBA = $this->generateFooterBA();
		createCache($MenuFooterBA,"menuFooterBA");
                $MenuFooterBB = $this->generateFooterBB();
		createCache($MenuFooterBB,"menuFooterBB");
                
                $MenuFooterC = $this->generateFooterC();
		createCache($MenuFooterC,"menuFooterC");
                