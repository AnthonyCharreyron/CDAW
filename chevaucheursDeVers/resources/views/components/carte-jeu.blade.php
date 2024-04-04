<div>
    <svg id="imageContainer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 533" width="800" height="533">
        <image xlink:href="{{ asset('images/ChevaucheursDeVers-plateau.png') }}" width="800" height="533" />
        @php
            $coordinates = explode(" ", "(89,99) (90,114) (136,124) (145,109) (166,110) (179,124) (280,64) (272,48) (311,47) (312,65) (500,104) (502,88) (292,72) (310,69) (312,162) (293,160) (525,83) (543,97) (581,60) (567,47) (599,56) (603,43) (681,118) (664,131) (673,160) (693,157) (712,236) (692,236) (533,124) (547,104) (658,135) (663,156) (693,271) (710,271) (715,425) (694,422) (614,346) (599,335) (683,268) (690,281) (501,295) (500,273) (682,248) (682,266) (522,358) (527,376) (583,364) (577,347) (599,367) (616,355) (689,420) (687,441) (680,441) (696,456) (616,501) (604,482) (512,390) (530,385) (595,479) (579,490) (409,391) (415,412) (498,387) (487,368) (452,352) (452,336) (509,352) (501,368) (430,325) (445,329) (484,296) (472,281) (469,222) (480,212) (487,266) (470,271) (393,494) (394,511) (587,515) (573,499) (369,484) (388,484) (409,426) (391,422) (361,488) (366,510) (232,509) (234,484) (207,474) (229,479) (253,400) (235,388) (199,473) (192,495) (55,406) (70,391) (369,316) (381,306) (420,329) (416,349) (182,352) (184,332) (233,363) (227,384) (28,359) (57,364) (103,250) (79,250) (58,128) (84,131) (100,212) (72,215) (109,222) (108,243) (211,236) (206,213) (213,211) (235,202) (181,138) (159,148) (236,200) (248,222) (292,198) (281,181) (325,172) (325,193) (455,213) (436,194) (451,113) (453,129) (513,122) (497,107) (247,352) (264,363) (361,317) (344,302) (160,324) (181,327) (234,242) (217,240) (78,392) (65,377) (148,346) (155,359) (63,354) (67,373) (148,347) (148,329) (256,397) (376,418) (374,402) (262,381) (379,385) (376,404) (263,381) (271,364) (299,205) (311,200) (349,284) (336,294) (331,195) (315,201) (350,287) (367,278) (414,150) (428,139) (457,192) (442,193) (450,140) (430,140) (459,191) (470,182)");

            $chunks = array_chunk($coordinates, 4);
            foreach ($chunks as $index => $coords) {
                $tab = [];
                foreach ($coords as $point) {
                    preg_match('/\((\d+),(\d+)\)/', $point, $matches);
                    $x = $matches[1]; 
                    $y = $matches[2];
                    $tab[] = $x;
                    $tab[] = $y;
                }
                // Utiliser implode pour générer une chaîne de coordonnées séparées par des virgules
                $coordsString = implode(',', $tab);
                if (session()->has('couleursJoueurs')) {
                    $couleur = session()->get('couleursJoueurs')[$user->pseudo];
                } else {
                    $couleur = '';
                }

                echo "<polygon class='rectangle' id='Zone_" . ($index + 1) . "' data-couleur='$couleur' points='$coordsString' />";
            }
            if (session()->has('couleursJoueurs') && session()->has('zonesPrises')) {
                $zonesPrises = session()->get('zonesPrises');
                $couleursJoueurs = session()->get('couleursJoueurs');

                function convertColor($color) {
                    switch($color) {
                        case 'bleu':
                            return 'blue';
                        case 'jaune':
                            return 'yellow';
                        case 'rouge':
                            return 'red';
                        case 'violet':
                            return 'purple';
                        case 'vert':
                            return 'green';
                        default:
                            return 'black';
                    }
                }

                foreach ($zonesPrises as $idZone => $pseudo) {
                    $color = isset($couleursJoueurs[$pseudo]) ? $couleursJoueurs[$pseudo] : '';
                    $color = convertColor($color);
                    echo "<style>#Zone_$idZone { fill: $color; }</style>";
                }
            } 
          
        @endphp
    </svg>
</div>
