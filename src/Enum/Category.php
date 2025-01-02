<?php
namespace BingNewsSearch\Enum;

enum Category:string # implements IMarketCategory
{
    case AUSTRALIA = 'Australia';
    case CANADA = 'Canada';
    case CHINA = 'China';
    case BRAZIL = 'Brazil';
    case INDIA = 'India';
    case LIFESTYLE = 'LifeStyle';
    case SCIENCEANDTECHNOLOGY = 'ScienceAndTechnology';
    case AUTO = 'Auto';
    case EDUCATION = 'Education';
    case MILITARY = 'Military';
    case REALESTATE = 'RealEstate';
    case SOCIETY = 'Society';
    case HEALTH = 'Health';
    case UK = 'UK';
    case PRODUCTS = 'Products';
    case US = 'US';
    case WORLD_AFRICA = 'World_Africa';
    case WORLD_AMERICAS = 'World_Americas';
    case WORLD_ASIA = 'World_Asia';
    case WORLD_EUROPE = 'World_Europe';
    case WORLD_MIDDLEEAST = 'World_MiddleEast';
    case BUSINESS = 'Business';
    case ENTERTAINMENT = 'Entertainment';
    case POLITICS = 'Politics';
    case SPORTS = 'Sports';
    case WORLD = 'World';
}
