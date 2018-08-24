<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Terms and Conditions'))
@section('currentNavItem', route('about'))

@push('styles')
@endpush

@push('scripts')
@endpush


@section('content')
	<h1>{{ __('Terms & conditions') }} / Användarvillkor</h1>

	<p style="font-style: italic">Uppdaterad: 2018-08-25</p>

	<p>Tack för att du använder imittpaket.se! Dessa användarvillkor går igenom ditt användande och åtkomst till imittpaket.se.</p>

	<h2>Ändring av villkoren - Sidan är under utveckling</h2>
	<p>imittpaket.se håller på att byggas upp på nytt på en ny plattform. Den nya versionen publicerades 2018-08-18 och är under aktiv uppbyggnad. Därför är det med största sannolikhet så att dessa användarvillkor kommer uppdateras då ny funktionalitet tillkommer eller justeras. </p>
	<p>Högst upp i dessa villkor står datumet för när villkoren uppdaterades.</p>

	<h2>Dina rättigheter</h2>
	<h3 class="h4">Användare</h3>
	<p>Det finns två olika typer av användare: Önskare och Givare</p>
	<h4 class="h5">Önskare</h4>
	<p>En Önskare har ett registrerat konto och kan logga in. Inloggad kan Önskaren skapa listor och prylar och kombinera dessa till önskelistor. Listorna är sedan tillgängliga för Önskaren att dela med sig av.</p>
	<h4 class="h5">Givare</h4>
	<p>En Givare har inget användarkonto, men finns ändå sparad i databasen (epostadress). Givaren kan markera prylar på en lista som ett sätt att säga "Den här prylen kommer jag ge". Den som önskat sig kommer inte se detta. Andra Givare kommer att se att just den prylen redan är markerad, men kan inte se av vem den är markerad. Samma Givare kan markera prylar på flera olika listor, men måste ange sin epostadress för varje separat lista.</p>

	<h3 class="h4">Publikt innehåll</h3>
	<p>Varje lista är publik och synlig via en unik länk, för att besökare som inte är inloggade ska kunna se den. Den unika länken har du tillgång till och du kan välja vilka du vill ge den till. Listan visar ditt namn, så som du registrerat det på ditt konto. Listan visar inte din epostadress.</p>
	<p>Dina prylar kan ingen annan se, om du inte lagt till dem på en lista.</p>

	<h3 class="h4">Din data</h3>
	<p>Du har rätt att få en samlad rapport av den datan vi har lagrat om dig. Kontakta oss enligt kontaktuppgifterna längst ner i dessa villkor.</p>

	<h2>Dina skyldigheter</h2>
	<p>Du är ansvarig för att informationen du uppger är korrekt. Du delar inte med dig av dina inloggningsuppgifter till obehöriga.</p>
	<p>Du får inte lägga till eller länka till innehåll som är olagligt eller kan verka stötande, som våld, kränkningar eller pornografi.</p>

	<h2>Våra rättigheter</h2>
	<p>För att kunna erbjuda dig som Önskare att använda tjänsten, så ger du oss tillgång till den data (listor, prylar, kontoinformation), som du skapar och hanterar när du är inloggad.</p>
	<p>För att kunna erbjuda dig som Givare att använda tjänsten så ger du oss tillgång till din epostadress.</p>
	<p>Den data du genererar är din. Vi kommer inte använda den till något utanför imittpaket.se. Vi kommer inte använda din epostadress för att skicka nyhetsbrev eller reklam.</p>

	<h2>Våra skyldigheter</h2>
	<p>Vi ser till att göra vårt bästa för att kontinuerligt kunna erbjuda dig tillgång till imittpaket.se</p>

	<h2>Avsluta konto</h2>
	<p>Du kan närsomhelst välja att avsluta ditt konto på imittpaket.se. Använd då epostadressen längst ner på sidan och så hjälper vi dig.</p>
	<p>Vi förbehåller oss rätten att blockera och/eller avsluta ditt konto om du:</p>
	<ul>
		<li>Bryter mot dessa användarvillkor</li>
		<li>Inte har varit inloggad på ditt registrerade konto under de senaste 12 månaderna.</li>
	</ul>
	<p>Om något av ovan skulle inträffa så kommer vi skicka ett meddelande till din registrerade epostadress i förväg, så att du har rimligt med tid på dig att åtgärda det vi påpekar.</p>

	<h2>Kontakt</h2>
	<p>E-mail: {!! HTML::mailto('info@imittpaket.se') !!}</p>

@endsection


@section('sidebar.left')
@endsection