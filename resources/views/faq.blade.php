@extends('layouts.frontend')
@section('content')
    <section id="breadcrumb-nav" class="row">
        <a href="#top"></a>
        <div class="col-lg-8 offset-lg-2">
            <!-- <nav aria-label="breadcrumb">-->
            <ol class="breadcrumb m-0 pt-5 pl-0 mb-4">
                <li class="breadcrumb-item"><a href="{{ route('index' )}}"><i class="fas fa-home mr-2"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Algemene Info</li>
            </ol>
            <!-- </nav>-->
        </div>
    </section>
    <section id="fqa" class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="col-8 offset-2 text-center">
                @if(Session::has('form_send'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('form_send') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <h3>INFORMATIE</h3>
            <div class="accordion shadow" id="accordionExample">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" id="headingTwo">
                        <h2 class="mb-0">
                            <button id="bestellen" class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                BESTELLEN & LEVEREN
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body border-bottom">
                            <h4>Wanneer ontvang ik mijn bestelling?</h4>
                            <p>Wij, onze partners en onze bezorgers doen er alles aan om de beloofde levertijd waar te maken.
                                Als dat onverhoopt niet lukt, brengen we je daarvan op de hoogte. </p>
                        </div>
                        <div class="card-body border-bottom">
                            <h4>Hoe snel ontvang ik een bestelling?</h4>
                            <p>Niets is zo belangrijk als de levertijd. Daarom zie je nog voordat je iets bestelt wanneer we het artikel bezorgen.
                                Artikelen die direct op voorraad zijn, heb je meestal de volgende dag in huis.
                                Artikelen die niet op voorraad liggen, zijn iets langer onderweg.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button id="betalen" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true"
                                    aria-controls="collapseOne">
                                BETALEN
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body border-bottom">
                            <h4>Hoe kan ik betalen?</h4>
                            <p>Met geld. Of cadeaubonnen. En welke methode je ook kiest, je betaalt sowieso veilig.</p>

                            <p>Achteraf betalen: via Bancontact of door het over te maken binnen 14 dagen na ontvangst van de artikelen.</p>
                            <p>Bancontact: via de vertrouwde online betaalomgeving van je bank.</p>
                            <p>Creditcard: het bedrag wordt gereserveerd en pas afgeschreven nadat je artikel geleverd is.</p>
                            <p>Cadeaubon: je voegt bij de stap ‘Betalen’ een kortingscode of cadeauboncode toe. Je ziet vanzelf of je een restbedrag
                                moet betalen.</p>
                        </div>
                        <div class="card-body">
                            <h4>Kan ik altijd achteraf betalen?</h4>
                            <p>Meestal wel. Als het niet kan, komt dat door 1 of meer van onderstaande factoren:</p>

                            <p>Totaalbedrag van je bestelling</p>
                            <p>Soort artikelen in je bestelling.</p>
                            <p>Eventueel onbetaalde facturen.</p>
                            <p>Aantal bestellingen dat je eerder bij ons geplaatst hebt.</p>
                            <p>Bezorging op een afhaalpunt.</p>
                            <p>1 van je facturen is overgedragen aan het incassobureau.</p>
                            <p>Je kunt je bestelling uiteraard wel afronden met een andere betaalmethode.</p>
                            <p>Betaal je liever niet meteen? Bij creditcard wordt het bedrag pas afgeschreven als je artikel geleverd is.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button id="retourneren" class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                RETOURNEREN
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body border-bottom">
                            <h4>Mag ik mijn artikelen retourneren?</h4>
                            <p>De retourvoorwaarden vind je hieronder. Waar het op neerkomt, is dat je rustig over je aankoop mag nadenken.
                                Als je artikel geen goede match is, mag je het gratis naar ons terugsturen binnen de zichttermijn.</p>
                            <h5>Retourvoorwaarden</h5>
                            <p><span>1.</span> Op onze artikelen is er altijd een retourtermijn van minstens 30 dagen.
                                De retourtermijn gaat in op de dag dat jij het artikel ontvangt.</p>
                            <p><span>2.</span> Het artikel zit in de originele verpakking (voor zover mogelijk).</p>
                        </div>
                        <div class="card-body border-bottom">
                            <h4>Moet ik betalen bij retourneren?</h4>
                            <p>Daar kunnen we kort en krachtig op antwoorden: nee, in de meeste gevallen niet.
                                Pakketjes en brievenbuspost verstuur je gratis.</p>
                        </div>
                        <div class="card-body border-bottom">
                            <h4>Hoe snel word ik terugbetaald na retourneren?</h4>
                            <p>We betalen je meteen terug zodra we je retourzending afgehandeld hebben.
                                De meeste retourzendingen hebben we verwerkt binnen 5 werkdagen nadat ze teruggestuurd zijn.
                                Hoe snel het geld daarna op je rekening staat, hangt af van je betaalmethode:</p>
                            <p><span>Bancontact of achteraf betalen:</span> binnen 3 werkdagen.</p>
                            <p><span>Kredietkaart:</span> binnen 5 werkdagen.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button id="garantie" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                GARANTIE
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body border-bottom">
                            <h4>Heb ik garantie op mijn artikelen?</h4>
                            <p>Natuurlijk! Wij <span>garanderen</span> dat je bij <span>Funko</span>King een artikel koopt dat in goede staat is en bij
                                normaal gebruik zoals verwacht blijft werken, dit is de wettelijke garantie.</p>
                        </div>
                        <div class="card-body border-bottom">
                            <h4>Wat is het garantiebewijs van mijn artikel?</h4>
                            <p>Je factuur of aankoopbewijs is ook meteen je garantiebewijs.</p>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="mt-5">HELP</h3>

            <div class="accordion shadow mb-lg-5" id="accordionExample1">
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button id="verzenden" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive"
                                    aria-expanded="true"
                                    aria-controls="collapseFive">
                                VERZENDEN
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body border-bottom">
                            <h4>Verzending:</h4>
                            <p>Na betaling wordt je bestelling zo snel mogelijk verstuurd! We versturen je bestelling binnen 1 tot 4 werkdagen.</p>
                            <p>Verzendkosten in Belgie bedragen 3,95 per pakket.</p>
                            <p class="font-weight-bolder">Bestel je boven de 50 euro in Belgie? Dan zijn de verzendkosten gratis!</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button id="privacy" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix">
                                PRIVACY
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body border-bottom">
                            <h4>Privacybeleid:</h4>
                            <p>Wij zijn er van bewust dat u vertrouwen stelt in ons. Wij zien het dan ook als onze verantwoordelijkheid om uw privacy te beschermen. Op deze pagina laten we u weten welke gegevens we verzamelen als u onze website gebruikt, waarom we deze gegevens verzamelen en hoe we hiermee uw gebruikservaring verbeteren. Zo snapt u precies hoe wij werken.

                                Dit privacybeleid is van toepassing op de diensten van funkopops.nl. U dient zich ervan bewust te zijn dat Funkoking
                                niet verantwoordelijk is voor het privacybeleid van andere sites en bronnen. Door gebruik te maken van deze website geeft u aan het privacy beleid te accepteren.

                                Funkoking respecteert de privacy van alle gebruikers van haar site en draagt er zorg voor dat de persoonlijke
                                informatie
                                die u ons verschaft vertrouwelijk wordt behandeld.</p>

                            <h4>Ons gebruik van verzamelde gegevens</h4>

                            <p class="font-weight-bolder">Gebruik van onze diensten</p>
                            <p>Wanneer u zich aanmeldt voor een van onze diensten vragen we u om persoonsgegevens te verstrekken. Deze gegevens
                                worden gebruikt om de dienst uit te kunnen voeren. De gegevens worden opgeslagen op eigen beveiligde servers van
                                Funkoking
                                of die van een derde partij. Wij zullen deze gegevens niet combineren met andere persoonlijke gegevens waarover
                                wij beschikken.</p>

                            <p class="font-weight-bolder">Communicatie</p>
                            <p>Wanneer u e-mail of andere berichten naar ons verzendt, is het mogelijk dat we die berichten bewaren. Soms vragen
                                wij u naar uw persoonlijke gegevens die voor de desbetreffende situatie relevant zijn. Dit maakt het mogelijk uw
                                vragen
                                te verwerken en uw verzoeken te beantwoorden. De gegevens worden opgeslagen op eigen beveiligde servers van
                                Funkoking of die van een derde partij. Wij zullen deze gegevens niet combineren met andere persoonlijke gegevens
                                waarover wij beschikken.</p>

                            <p class="font-weight-bolder">Cookies</p>
                            <p>Wij verzamelen gegevens voor onderzoek om zo een beter inzicht te krijgen in onze klanten, zodat wij onze diensten
                                hierop kunnen afstemmen.
                                Deze website maakt gebruik van “cookies” (tekstbestandtjes die op uw computer worden geplaatst) om de website te helpen analyseren hoe gebruikers de site gebruiken.
                                De door het cookie gegenereerde informatie over uw gebruik van de website kan worden overgebracht naar eigen
                                beveiligde servers van Funkoking of die van een derde partij. Wij gebruiken deze informatie om bij te houden hoe u
                                de website gebruikt, om rapporten over de website-activiteit op te stellen en andere diensten aan te bieden
                                met betrekking tot website-activiteit en internetgebruik.</p>

                            <p class="font-weight-bolder">Doeleinden</p>
                            <p>We verzamelen of gebruiken geen informatie voor andere doeleinden dan de doeleinden die worden beschreven in dit
                                privacybeleid tenzij we van tevoren uw toestemming hiervoor hebben verkregen.</p>

                            <p class="font-weight-bolder">Derden</p>
                            <p>De informatie wordt niet met derden gedeeld. In enkele gevallen kan de informatie intern gedeeld worden. Onze
                                werknemers zijn verplicht om de vertrouwelijkheid van uw gegevens te respecteren.</p>

                            <p class="font-weight-bolder">Veranderingen</p>
                            <p>Deze privacyverklaring is afgestemd op het gebruik van en de mogelijkheden op deze site. Eventuele aanpassingen
                                en/of veranderingen van deze site, kunnen leiden tot wijzigingen in deze privacyverklaring.
                                Het is daarom raadzaam om regelmatig deze privacyverklaring te raadplegen.</p>

                            <p class="font-weight-bolder">Keuzes voor persoonsgegevens</p>
                            <p>Wij bieden alle bezoekers de mogelijkheid tot het inzien, veranderen, of verwijderen van alle persoonlijke
                                informatie die op moment aan ons is verstrekt.</p>

                            <p class="font-weight-bolder">Aanpassen/uitschrijven dienst nieuwsbrief</p>
                            <p>Onderaan iedere mailing vindt u de mogelijkheid om uw gegevens aan te passen of om u af te melden.</p>

                            <p class="font-weight-bolder">Aanpassen/uitschrijven communicatie</p>
                            <p>Als u uw gegevens aan wilt passen of uzelf uit onze bestanden wilt laten halen, kunt u contact met ons op nemen.
                                Zie onderstaande contactgegevens.</p>

                            <p class="font-weight-bolder">Cookies uitzetten</p>
                            <p>De meeste browsers zijn standaard ingesteld om cookies te accepteren, maar u kunt uw browser opnieuw instellen om
                                alle cookies te weigeren of om aan te geven wanneer een cookie wordt verzonden.</p>

                            <p class="font-weight-bolder">Vragen en feedback</p>
                            <p>We controleren regelmatig of we aan dit privacybeleid voldoen. Als u vragen heeft over dit privacybeleid, kunt u
                                contact met ons opnemen: via Contact</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSeven">
                        <h2 class="mb-0">
                            <button id="contact" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven"
                                    aria-expanded="false" aria-controls="collapseSeven">
                                CONTACT
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                        <div class="card-body">
                            <form action="{{ action('ContactController@store') }}" method="post">

                                @csrf

                                <label class="mt-3">Ordernummer: <small class="text-muted">(Optional)</small></label>
                                <input type="text" name="ordernumber" class="form-control">
                                <label class="mt-3">Onderwerp:</label>
                                <input type="text" name="subject" id="contact-subject" class="form-control">
                                <label class="mt-3">Je bericht:</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                <div><button type="submit" id="btn-verstuur" class="btn btn-success rounded-0 my-4">Verstuur</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center my-4"><a href="#top" id="link-up" class="btn box px-4 py-2">Top</a></div>
        </div>
        <div class="col-lg-2 d-lg-flex align-items-lg-center p-0">
            <img id="picture-help" class="img-fluid d-none d-lg-block" src="images/help-picture-small.png" alt="help-side-picture">
        </div>
    </section>
    @endsection
