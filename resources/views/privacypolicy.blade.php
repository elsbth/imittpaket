<!-- extend and send page-specific data to layouts/app.blade.php -->

@extends('layouts.app')

@section('title', __('Privacy policy'))
@section('currentNavItem', route('about'))

@push('styles')
@endpush

@push('scripts')
@endpush


<!-- build page content -->

@section('content')
	<h1><i class="fas fa-user-shield"></i> {{ __('Privacy policy') }}</h1>

	<h2>Varför ska jag läsa denna policy?</h2>
	<p>Denna policy beskriver hur vi på samlar in, använder och skyddar dina personuppgifter.</p>

	<h2>Vilken information samlar ni in om mig?</h2>
	<p>Vi samlar in information som hjälper oss att tillhandahålla en tjänst till dig, det inkluderar:</p>

	<ul>
		<li>E-postadress</li>
		<li>Namn</li>
		<li>Födelsedag (frivilligt)</li>
	</ul>

	<h2>Hur kommer ni använda min information?</h2>
	<p>Vi behöver veta en del om dig för att kunna förse dig med informationsutskick (gällande förändringar och viktiga uppdateringar av tjänsten) och statistik i linje med denna övergripande policy. Vi kommer inte samla in mer information än vi behöver för att tillhandahålla våra tjänster till dig.</p>

	<h2>Hur länge kommer du ha min information?</h2>
	<p>Information som vi använder för att tillhandahålla tjänsten kommer behållas fram tills den tidpunkt du själv väljer att avsluta användningen.</p>

	<h2>Med vilka delar ni min information med?</h2>
	<p>Dina personuppgifter kan komma att hanteras av personal i Sverige, ingen tredje part har tillgång till dina personuppgifter så länge inte lagen kräver att vi delar den.</p>

	<p>Vi har verktyg på plats för att säkerställa att dina personuppgifter hanteras tryggt och säkert enlighet med gällande lagstiftning.</p>

	<h2>Var har du min information?</h2>
	<p>Din information lagras i datacenter inom den Europeiska Unionen. Av tekniska skäl så kan våra underleverantörer behöva flytta information till andra länder utanför EU. Om detta sker så används lämpliga skyddsåtgärder och standardiserade dataskyddsbestämmelser som godkänts av EU-kommissionen.</p>

	<h2>Vad är mina rättigheter?</h2>
	<p><strong>Rätt till information:</strong> Du kan begära att få en kopia på de personuppgifter vi har om dig.
		<br /><strong>Rätt till rättelse:</strong> Vi vill säkerställa att din information är uppdaterad och korrekt. Du kan begära att få din information rättad eller borttagen om du anser att den är inkorrekt.
		<br /><strong>Rätt till radering:</strong> Du kan begära att vi ska radera dina personuppgifter. Vi får inte radera uppgifter som lagen kräver att vi behåller.
		<br /><strong>Dataportabilitet:</strong> Du kan be oss att flytta dina personuppgifter från vår IT miljö till någon annan, antingen ett annat företag eller till dig. Detta gäller inte uppgifter som lagen kräver att vi behåller
		<br /><strong>Ta tillbaka samtycke:</strong> Du kan ta tillbaka ditt samtycke till att dela din information eller att ta emot marknadsföring / utskick när som helst. Antingen genom att avprenumerera från meddelandet eller kontakta oss via e-post.
		<br /><strong>Klagomål:</strong> Du kan kan lämna ett klagomål till datainspektionen om du anser att vi behandlar dina personuppgifter i strid med dataskyddsförordningen.</p>

	<h2>Hur kan jag använda mina rättigheter?</h2>
	<p>Om du vill använda någon av dina rättigheter så kontaktar du oss via e-post som finns längst ned i denna policy. Om du vill lämna ett klagomål till datainspektionen så behöver du kontakta dem.</p>

	<h2>Uppdateringar till denna policy</h2>
	<p>Vi kan komma att uppdatera denna policy och kommer då publicera dem på denna webbsida. Denna policy uppdaterades senast den <strong>24 august 2018</strong>.</p>

	<h2>Hur du kan kontakta oss</h2>
	<p>Om du har några frågor angående denna policy eller hur vi använder din information, eller dina rättigheter så kan du kontakta oss på följande adress:</p>

	<p>E-mail: {!! HTML::mailto('info@imittpaket.se') !!}</p>

@endsection


@section('sidebar.left')
@endsection