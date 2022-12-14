##  Парадигмы ООП.

Лекции по видео ["Парадигмы ООП"](https://www.youtube.com/watch?v=G6LJkWwZGuc)

### Использовать интерфейсы
- Публичный протокол. Можно понять, какие методы просто public, какие - public потому что протокол.
- Легче тестировать. Если класс А зависит от класса В, то можно установить требование. Т.е. откладывать решение, которое на данный момент не имеет значения на потом.
- Облегчает логику.
- Легче масштабировать.

### Наследование (говорит что зло и что нужно избегать)
- Заменить композицией.
- Модификатор protected. В дочернем можно сделать public и все...
- Зависимость от фреймворка. Тут он говорит что опасно наследоваться от классов фреймворка, т.к. мы не контролируем его код. Наверно если это свой класс, то не так страшно.

### Инкапсуляция
Тут рассказывает об опасности геттеров и сеттеров. Например, есть класс Book и у него свойство author (string).
Можно сделать геттер/сеттер на свойство author и будет все норм работать пока свойство примитив.
Как только свойство станет объектом Author, то без дополнительных усилий нельзя инкапсулировать этот объект.

Поэтому может быть public свойства не так уж и плохи?
Если четко знать для каких целей используется этот объект.

Объекты приложения делятся на несколько категорий:
- Доменные объекты - обладают каким-то поведением, которые дают возможность работать над внутренним состоянием.
- Объекты DTO - его задача передавать данные из A в B.
- Объекты VO (value object) - объекты, которые возвращаются (в идеале не меняются).

### SOLID. Принципы дизайна
- SRP - single responsibility principle. Одна ответственность.
- OCP - open/close principle. Закрыть базовый класс для модификаций, может быть final методы.
- LSP - Liskov substitution principle. Если вы создаете нескольких наследников одного и того же интерфейса (абстрактного 
класса), то они должны вести себя так же. Квадрат не должен наследоваться от прямоугольника.
- ISP - interface segregation principle. Мелкие интерфейсы, разделенные по задачам/ролям.
- DIP - dependency inversion principle. Классы должны зависеть от абстракций, а не от конкретных деталей.
Вы не должны заботиться о создании своих зависимостей самостоятельно, а должны получать их откуда-то. Должно
быть третье место, которое заботится о том, чтобы вы получили правильную зависимость.
Но это не значит что вы должны использовать только DI, можно паттерн репозиторий, сервис локатор.

Не забывать про: DRY + KISS + YAGNI.

### DAO layer for data access
Data access object - тот уровень, который отвечает за доступ к данным. Зачем нужно? Чтоб менять хранилище, которым пользуемся.
Сейчас считается что нужно выбирать хранилище под задачу, т.е. бизнес логика не должна измениться.

И если не вводить уровень абстракции между хранилищем данных и конкретными searcher-ами, то придется постоянно менять код, зависимость.

Но самое главное использования DAO - это помнить про принципы дизайна. Например, есть бизнес-сервис, в котором есть бизнес-логика и
 в нем же есть использование данных, то есть бизнес-сервис уже отвечает за 2 вещи:
- за бизнес-правила
- за детали, каким образом сохраняются данные.

2 ответственности, придется каждый раз менять сервис при изменении логики или хранилища.

### Вся логика должна быть вынесена в сервис
Даже если кажется что нет логики, она есть, просто скрыта за средствами разработки:
- транзакции (asid)
- валидация

### Не надейтесь на фреймворки
А как легко я смогу спрыгнуть с этого фреймворка?