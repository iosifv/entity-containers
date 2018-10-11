# entityContainers

entityContainers is a library that can be used to create entities which have to be sent through an API and reconstructed at the other end.
Those entities can also be organized into containers. 

## Installation

Use [Composer](https://getcomposer.org/) to download and install the library as well as its dependencies.


## Integration

There is a class folder which is meant to be an example of how to build your entity classes in order to take full advantage of the library.
There are some traits which need to be added to your entities depending on the needs of your project: FactoryMethodTrait, GetDataMethodTrait, MergeMethodTrait
The tests are also very good examples of what the library is capable of.

## Main Features

* A bunch of entity objects can be stored into an Entity Container
* An Entity can contain other Entities or Containers.
* A Container can only keep Entities which are the same class.
* getData() method will return a formatted array which contains all information about the object
* factory() method will create a new Entity or Container object with all information set
* This will always be true: $entity = EntityClass::factory($entity->getData())
* If the entity reflects the database, the factory() method can be called with the result of a FETCH_ASSOC call.

## File Structure
```
entityContainers
├── src
│   ├── abstracts           * stores abstract classes
│   ├── exceptions
│   ├── interfaces          * stores interfaces needed for entities
│   ├── sampleEntity        * sample entity classes
│   │   └── containers      * containers for the sample entities
│   └── traits
│       ├── methods         * traits related to a functionality
│       └── properties      * traits related to a possible property
├── tests                   * PHPUnit tests
└── vendor

```
## Author

* [vighiosif](https://github.com/vighiosif)

The present library is my approach on the initial code from [degola](https://github.com/degola).
