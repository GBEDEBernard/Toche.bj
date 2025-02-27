@extends('bloglayout')


@section('contenu')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apropos</title>
    </head>
    <body>
   
     <div class="flex justify-center w-full mt-4 mb-6 p-2">
     <div class="w-3/5 h-full rounded-t-lg md:rounded-t-lg md:w-4/6   border-3 shadow-md p-2">
        <img class="rounded-t-lg hover:opacity-80  md:h-[400px] md:w-full" src="{{ asset('/image/Cotonou.jpeg')}}" alt="voudou days  ">
         <div class="flex justify-center">
           <a class="w-16 md:w-44" href="{{ route('accueil') }}"><img class="rounded-full w-32 md:w-32 hover:opacity-80" src="{{ asset('image/logo3.jpg')}}" alt="Toché"> </a>
        </div>

      <h2 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl hover:text-violet-600">TOCHE LE MIROIRE DU TOURISME DU BENIN</h2>
       <h3 class="md:text-bleu-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl hover:text-violet-600"> COTONOU GODOMEY-TOGOUDO</h3>
      <h4 class="md:text-black-700 text-black-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl hover:text-violet-600">Tel:+229 01 65 10 39 59 / +229 01 69 58 06 03</h4>
  </div>
     </div>

  {{--div des  page informations sa baniere sur la page vodoudays--}}

       <div class="text-center font-bold text-sm md:text-3xl lg:text-5xl">
           <h1 class="hover:opacity-80 m-8">Apropos du Toché</h1>
      </div>

      <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100  md:rounded-lg shadow-md border-2">        
          <div >
          <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">MISSION</h3>
          <p class="p-2 ">
            La création d’un site internet adapté à un Site touristique permet par ailleurs d’attirer davantage 
            de visiteurs et d’augmenter vos chances de trouver des clients. L’ajout d’outils de réservation 
            en ligne fluidifie en effet pour vos hôtes et simplifie la gestion des activités au quotidien. Une 
           interface bien conçue et optimisée pour le référencement améliore quant à elle votre visibilité sur
           les moteurs de recherche. Il devient alors
           plus facile pour les voyageurs de trouver votre hébergement lorsqu’ils recherchent une destination dans la région.
          </p>
          </div>
          <img class="w-2/5 h-32 md:w-44 md:h-44 hover:opacity-80 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/dg.png')}}" alt="voudou days  ">
        </div>
 
        <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2 p-4">
        <img class="w-2/5 h-32 md:w-44 hover:opacity-80 md:h-44 md:rounded-lg mt-8 p-2 md:p-2 " src="{{ asset('/image/gamali.jpg')}}" alt="voudou days  ">
         <div>
         <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">Objectifs de toché</h3>
          <p class="p-2 ">
          <h3>
          Les solutions complémentaires pour une gestion optimisée des sites touristiques
          </h3>  
          Une plateforme performante de <strong> Gestion des sites touristiques</strong> peut grandement faciliter le management de votre établissement, notamment 
          lorsque vous y associez les bons outils numériques. Ceux-ci permettent de gagner du temps, de simplifier 
          les tâches quotidiennes et de fournir un service client irréprochable. Je vous conseille d’intégrer un système 
          de réservation en ligne qui sert à vérifier s’il y a des chambres libres et de réserver en quelques clics. Synchronisez-le 
          avec un calendrier global pour éviter qu’un même lieu soit loué par plusieurs personnes
           simultanément. On retrouve ensuite l’utilisation d’un logiciel de gérance pour centraliser les opérations. Il vous aide à :

           <li>suivre les enregistrements,</li>
           <li>gérer les paiements,</li>
           <li>automatiser l’envoi d’e-mails de confirmation ou de remerciements.</li>
              
          </p>class="w-2/5 h-32 md:w-2/3 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 "
          <p class="p-2 ">
             Certaines versions avancées proposent même des statistiques détaillées sur vos performances,
              ce qui peut être utile pour ajuster les tarifs ou les stratégies marketing. Servez-vous également
              des réseaux sociaux pour attirer une communauté plus large. Reliez l’adresse web de l’entreprise à vos
              comptes Instagram ou Facebook pour rediriger les internautes vers la page de réservation. De plus, partagez 
              régulièrement des photos et des anecdotes sur la propriété pour renforcer votre présence en ligne. Créez un blog 
              ou une rubrique actualités pour publier des articles sur les attractions locales,
             les événements à venir ou des astuces pratiques. Cela va enrichir le contenu, parfaire votre SEO et fidéliser votre audience.
          </p>
         </div>
        </div>


         <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2">
          <div class="p-3">
           <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">Défis à Réléver pour TOCHE</h3>
            <p class=>
            <h3>Qu'est-ce que nous voulons amémiore?</h3>
            Ce chapitre introductif présente et analyse certains des principaux défis et tendances (changement climatique, surtourisme, 
            menaces pour la diversité, sécurité, technologie, problèmes de main-d'œuvre et compétitivité) auxquels le secteur du tourisme 
            est cConnexiononfronté et qui doivent être abordés par tout gouvernement et gestionnaire qui a l'ambition de diriger une destination 
            responsable, durable et compétitive. Le chapitre propose d'envisager le tourisme d'un point de vue différent et plus 
            holistique : le tourisme ne doit pas être considéré uniquement comme un moteur économique qui vend des services, mais
             comme une activité qui fait partie d'un système naturel et socioculturel mondial qui est impacté par le tourisme
              (à la fois positivement et négativement) et qui devrait également contribuer à l'amélioration et à la durabilité.
               Il explique comment les destinations intelligentes nécessitent des solutions de développement, de gestion et de 
               marketing innovantes pour relever ces défis et tendances afin d'atteindre les objectifs de développement durable (ODD).
                Enfin, le chapitre présente et propose 
            le modèle du Secrétariat d'État espagnol au tourisme, développé par SEGITTUR, pour la gestion intelligente du tourisme.
            </p>
          </div>
          <img class="w-2/5 h-32 md:w-2/3 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/mario.jpg')}}" alt="voudou days  ">
         </div>


        <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2">
             <img class="w-2/5 h-32 md:w-44 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/mrdidier.jpeg')}}" alt="voudou days  ">
           <div class="p-2">
              <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">Quels sont les avantages des sites touristiques?</h3>
              <p>
                 Le tourisme contribue à la participation des individus à la vie sociale, à sa culture et à ses valeurs et 
                 permet le développement d'une personnalité, notamment par la découverte, la liberté et le retour à soi-même qu'il comporte.
             </p>
          </div>
        </div>


        <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2">
               <div class="p-2">
                   <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">Comment fonctionne un site touristique ?</h3>
                   <p>         
                         Un site touristique est un lieu de passage, mais non de séjour, car il est sans fonction d'hébergement,
                        ou à capacité d'hébergement sans commune mesure avec sa 
                        fréquentation. Il s'agit d'un type de lieu touristique créé par invention, c'est-à-dire par le regard et l'usage des touristes.
                  </p>
              </div>
             <img class="w-1/3 h-32 md:w-44 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/gestion1.jpg')}}" alt="voudou days  ">
        </div>

       
        <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2">
        <img class="w-2/3 h-32 md:w-44 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/objet d\'art2.webp')}}" alt="voudou days  ">
        <div class="p-2">
         <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">  Comment valoriser un site touristique ?</h3>
            <p>          
                On peut ainsi 
              <ul>
                   <li> 1) simplement protéger l'objet, sans pour autant en créer un site ; </li>
                   <li>  2) mettre en valeur l'objet, selon ses caractéristiques ;</li>
                   <li>  3) l'interpréter, c'est-à-dire superposer à la mise en valeur  un cadre de référence discursif expliquant, pour le touriste, la spécificité de l'objet ; </li>
              </ul>  
           </p>
        </div>
        </div>


        <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2">
        <div >
         <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl"> Qu'est-ce qui attire les touristes ?</h3>
              <p>
                Désormais, les touristes préfèrent des vacances dynamiques, mémorables et pleines 
                 d'expériences. En effet, la tendance actuelle est plus orientée vers des vacances courtes (parfois 
                  un week-end) dont le but n'est pas de se reposer, mais plutôt de se changer les idées en découvrant de nouvelles choses.
             </p>
              </div>
           <img class="w-2/5 h-32 md:w-44 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/Gestion3.jpg')}}" alt="voudou days  ">
        </div>

        <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2">
        <img class="w-2/5 h-32 md:w-44 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/gestion4.jpg')}}" alt="voudou days  ">
        <div >
             <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">Quelles sont les 10 importances du tourisme ?</h3>
             <p>
                Le tourisme offre de grandes opportunités aux économies émergentes et 
               aux pays en développement. Il crée des emplois, renforce l’économie locale, contribue au développement 
               des infrastructures locales et peut contribuer à préserver
               l’environnement naturel, les richesses culturelles et les traditions, ainsi qu’à réduire la pauvreté et les inégalités.
             </p>
          </div>
        </div>
        
        
        <div class="text-sm mt-4 mb-8 lg:text-xl flex text-justify bg-gray-100 md:rounded-lg shadow-md border-2">
         <div >
              <h3 class="text-center text-blue-700 font-bold text-sm md:text-xl lg:text-2xl">Comment rentabiliser un site touristique ?</h3>
             <p>
                Proposer vos propres services est le meilleur moyen
                de monétisation si vous savez bien vous y prendre. Si vous avez un blog de tourisme, 
                je vous conseille de proposer des visites guidées. L'idée
                est alors de proposer vos propres visites guidées. Vous pouvez les faire vous-même si vous n'avez pas beaucoup de demande.
             </p>
         </div>
         <img class="w-2/5 h-32 md:w-44 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/Gestion5.jpg')}}" alt="voudou days  ">
         </div>


       <div class="w-4/5 mb-4 flex ">
            <h2 class="text-black-700 hover:text-bleu-600 font-bold text-sm md:text-xl lg:text-4xl mb-4">Equipes</h2>
            <div class="flex justify-between mt-8">
             <div class="">
                  <img class="w-[650px] h-[100px] md:w-96 md:h-[320px] hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/GBEDE  Bernard1.jpg')}}" alt="voudou days  ">
                  <h4 class="md:text-black-600 text-blue-700 font-bold mt-2 ml-2 text-sm md:text-xl lg:text-xl hover:text-violet-600">GBEDE Bernard</h4>            
             </div>

             <div class="imag">
                  <img class="w-[650px] h-[100px]  md:h-[320px] md:w-96 hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/Gestion5.jpg')}}" alt="voudou days  ">
                  <h4 class="md:text-black-600 text-blue-700 font-bold mt-2 ml-2 text-sm md:text-xl lg:text-xl hover:text-violet-600">HOUNDJO COCOU Landry</h4>            
             </div>

             <div class="imag">
                 <img class="w-[650px] h-[100px] md:w-96  md:h-[320px] hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/Gestion5.jpg')}}" alt="voudou days  ">
                 <h4 class="md:text-blac-600 text-blue-700 font-bold mt-2 ml-2 text-sm md:text-xl lg:text-xl hover:text-violet-600">ATIMBADA Justin</h4>            
             </div>

             <div class="imag">
                 <img class="w-[700px] h-[100px] md:w-96  md:h-[320px] hover:opacity-80 md:h-44 md:rounded-lg mt-4 p-2 md:p-2 " src="{{ asset('/image/Gestion5.jpg')}}" alt="voudou days  ">
                 <h4 class="md:text-black-600 text-blue-700 font-bold mt-2 ml-2 text-sm md:text-xl lg:text-xl hover:text-violet-600">ZOGBODO Martial</h4>            
             </div>
        </div>
       </div>
    </body>
    </html>
@endsection