# Documentation de l'API

Bienvenue dans la documentation de l'API ! Cette API permet d'accéder à diverses fonctionnalités liées aux itinéraires de voyage.

## Authentification

L'API utilise une authentification par token JWT (JSON Web Token). Pour utiliser les endpoints protégés, vous devez fournir un token JWT dans l'en-tête Authorization.

## Itinéraires

### Liste des Itinéraires

Endpoint : `GET /itineraries/all`

Cette endpoint récupère la liste de tous les itinéraires disponibles.

#### Paramètres de Requête

Aucun

#### Réponses

- 200 OK : Retourne la liste des itinéraires au format JSON.
- 401 Unauthorized : Non autorisé, l'utilisateur doit être authentifié.

### Rechercher des Itinéraires

Endpoint : `GET /itineraries/search`

Cette endpoint permet de rechercher des itinéraires en fonction de certains critères.

#### Paramètres de Requête

- `category` : Catégorie de l'itinéraire (plage, montagne, rivière, monument)
- `duration` : Durée de l'itinéraire en jours

#### Exemple de Requête
`GET /itineraries/search?category=montagne&duration=3``

#### Réponses

- 200 OK : Retourne la liste des itinéraires correspondant aux critères de recherche.
- 400 Bad Request : Requête invalide si les paramètres sont manquants ou incorrects.

## Destinations

### Liste des Destinations d'un Itinéraire

Endpoint : `POST /itineraries/{itinerary_id}/destinations`

Cette endpoint ajouter la liste des destinations pour un itinéraire spécifié par son ID.

#### Paramètres de Requête

- `itinerary_id` : ID de l'itinéraire dont vous souhaitez obtenir les destinations.

#### Réponses

- 200 OK : Retourne la liste des destinations de l'itinéraire au format JSON.
- 404 Not Found : Itinéraire non trouvé si l'ID spécifié n'existe pas.

## Ajouter une Destination à un Itinéraire

Endpoint : `POST /itineraries/{itinerary_id}/destinations`

Cette endpoint permet d'ajouter une nouvelle destination à un itinéraire existant.

#### Paramètres de Requête

- `itinerary_id` : ID de l'itinéraire auquel vous souhaitez ajouter la destination.

#### Corps de la Requête

```json
{
    "name": "Destination Name",
    "accommodation": "Lieu de Logement",
    "places_to_visit": ["Lieu 1", "Lieu 2", "Lieu 3"]
}
```
#### Réponses

- 201 Created : Destination ajoutée avec succès à l'itinéraire.
- 400 Bad Request : Requête invalide si des champs requis sont manquants ou incorrects
- 404 Not Found : Itinéraire non trouvé si l'ID spécifié n'existe pas.

Cette documentation fournit un aperçu des fonctionnalités de base de l'API, des endpoints disponibles, des paramètres de requête, des réponses attendues et des exemples de requêtes. Vous pouvez continuer à ajouter des sections et des détails en fonction des fonctionnalités spécifiques de votre API. Une fois la documentation complétée, vous pouvez la partager avec les utilisateurs de votre API pour les aider à comprendre et à utiliser efficacement vos services.

