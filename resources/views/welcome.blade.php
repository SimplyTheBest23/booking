@extends('layouts.general')

@section('content')

  <div class="slider">
        <dialog open>
                <form>
                <div class="filter filter1">
                        <label>
                                Населений пункт:
                                <select class="form-control input-sm">
                                    @foreach($cities as $city)
                                        <option value="{{$city['id']}}">{{$city['city']}}</option>
                                    @endforeach
                                </select>
                        </label>
                        <label>
                                Вид житла:
                                <select class="form-control input-sm">
                                    @foreach($htypes as $htype)
                                        <option value="{{$htype['id']}}">{{$htype['hotel_type']}}</option>
                                    @endforeach
                                </select>
                        </label>
                </div>
                <div class="stick"></div>
                <div  class="filter filter2">
                        <label>
                                Кількість кроватей:
                                <select class="form-control input-sm" id="beds">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                </select>
                        </label>
                        <div class="check">
                                <label class="check" for="reight">Фільтрувати за <br>рейтингом:
                                <input type="checkbox" name="" id="reight"><span></span></label>
                        </div>
                </div>
                <div class="stick"></div>
                <div  class="filter filter3">
                        <div class="check">
                                <label for="bath">Душ
                                <input type="checkbox" name="" id="bath"><span></span>
                                </label>
                        </div>
                        <div class="check">
                                <label for="tualet">Туалет
                                <input type="checkbox" name="" id="tualet"><span></span>
                                </label>

                        </div>
                        <div class="check">
                                <label for="cond">Кондиціонер
                                <input type="checkbox" name="" id="cond"><span></span>
                                </label>
                        </div>
                        <div class="check">
                                <label for="tv">Телевізор
                                <input type="checkbox" name="" id="tv"><span></span>
                                </label>
                        </div>
                        <div class="check">
                                <label for="hol">Wi-fi
                                <input type="checkbox" name="" id="hol"><span></span>
                                </label>
                        </div>
                        <div class="check">
                                <label for="kitchen">Кухня
                                <input type="checkbox" name="" id="kitchen"><span></span>
                                </label>
                        </div>
                </div>
                <div class="stick"></div>
                <div class="filter filter4">
                        <h3>Кількість результатів</h3>
                        <h2>0</h2>
                        <button class="btn btn-success">Шукати</button>
                </div>
                </form>
        </dialog>
        <button>Шукати інші оголошення</button>
</div>
<main>
        <div class="main_head">
        <h1>Оренда житла</h1>
                <form>
                        <select name="" id="" class="form-control input-sm">
                                <option value="0">Сортувати</option>
                                <option value="1">Спочатку дешевші</option>
                                <option value="2">Спочатку дорожчі</option>
                        </select>
                </form>
        </div>
        <div class="green"></div>
                <div class="grey"></div>
        <div>
                <section class="book-adds">

                        <aside>
                                <div class="photo">
                                        <img src="../img/hotel.jpg" alt="hotel_photo">
                                        <img src="../img/images.png" alt="images" class="images">
                                        <div class="vip"></div>
                                </div>
                                <div class="content">
                                        <h3>База "Луч"</h3>
                                        <div><img src="../img/beach.png" alt="beach">
                                                <div class="info-beach">
                                                        Відстань до пляжу
                                                </div>
                                                <span>24</span> м до пляжа
                                                <img src="../img/home.png" alt="home">
                                                <div class="info-rooms">
                                                        всього номерів
                                                </div>
                                                <span>25</span> кімнат
                                                <img src="../img/lux.png" alt="bath">
                                                <div class="info-bath">
                                                        номерів Люкс
                                                </div>
                                                <span>5</span> номерів Люкс
                                        </div>
                                        <div>
                                                <img src="../img/marker.png" alt="marker">
                                                <span>с.Світязь. вул.Велика Морська 5</span>
                                        </div>
                                        <div>
                                                <img src="../img/phone.png" alt="phone">
                                                <span class="phone">+38 099 444 33 22</span>
                                        </div>
                                        <article>Но только что он вступил в столовую (еще через одну комнату от гостиной), с ним в дверях почти столкнулась выходившая в дверях почти столкнулась </article>

                                        <div class="grey"></div>
                                        <div class="details">
                                                від <span>300</span> грн/доба
                                                <a href="#" class="btn btn-success pull-right">Детальніше</a>
                                        </div>
                                </div>
                        </aside>
                        <aside>
                                <div class="photo">
                                        <img src="../img/hotel.jpg" alt="hotel_photo">
                                        <img src="../img/images.png" alt="images" class="images">
                                        <div class="vip"></div>
                                </div>
                                <div class="content">
                                        <h3>База "Луч"</h3>
                                        <div><img src="../img/beach.png" alt="beach">
                                                <div class="info-beach">
                                                        Відстань до пляжу
                                                </div>
                                                <span>24</span> м до пляжа
                                                <img src="../img/home.png" alt="home">
                                                <div class="info-rooms">
                                                        всього номерів
                                                </div>
                                                <span>25</span> кімнат
                                                <img src="../img/lux.png" alt="bath">
                                                <div class="info-bath">
                                                        номерів Люкс
                                                </div>
                                                <span>5</span> номерів Люкс
                                        </div>
                                        <div>
                                                <img src="../img/marker.png" alt="marker">
                                                <span>с.Світязь. вул.Велика Морська 5</span>
                                        </div>
                                        <div>
                                                <img src="../img/phone.png" alt="phone">
                                                <span class="phone">+38 099 444 33 22</span>
                                        </div>
                                        <article>Но только что он вступил в столовую (еще через одну комнату от гостиной), с ним в дверях почти столкнулась выходившая в дверях почти столкнулась </article>

                                        <div class="grey"></div>
                                        <div class="details">
                                                від <span>300</span> грн/доба
                                                <a href="#" class="btn btn-success pull-right">Детальніше</a>
                                        </div>
                                </div>
                        </aside>
                        <aside>
                                <div class="photo">
                                        <img src="../img/hotel.jpg" alt="hotel_photo">
                                        <img src="../img/images.png" alt="images" class="images">
                                        <div class="top"></div>
                                </div>
                                <div class="content">
                                        <h3>База "Луч"</h3>
                                        <div><img src="../img/beach.png" alt="beach">
                                                <div class="info-beach">
                                                        Відстань до пляжу
                                                </div>
                                                <span>24</span> м до пляжа
                                                <img src="../img/home.png" alt="home">
                                                <div class="info-rooms">
                                                        всього номерів
                                                </div>
                                                <span>25</span> кімнат
                                                <img src="../img/lux.png" alt="bath">
                                                <div class="info-bath">
                                                        номерів Люкс
                                                </div>
                                                <span>5</span> номерів Люкс
                                        </div>
                                        <div>
                                                <img src="../img/marker.png" alt="marker">
                                                <span>с.Світязь. вул.Велика Морська 5</span>
                                        </div>
                                        <div>
                                                <img src="../img/phone.png" alt="phone">
                                                <span class="phone">+38 099 444 33 22</span>
                                        </div>
                                        <article>Но только что он вступил в столовую (еще через одну комнату от гостиной), с ним в дверях почти столкнулась выходившая в дверях почти столкнулась </article>

                                        <div class="grey"></div>
                                        <div class="details">
                                                від <span>300</span> грн/доба
                                                <a href="#" class="btn btn-success pull-right">Детальніше</a>
                                        </div>
                                </div>
                        </aside>
                        <aside>
                                <div class="photo">
                                        <img src="../img/hotel.jpg" alt="hotel_photo">
                                        <img src="../img/images.png" alt="images" class="images">
                                </div>
                                <div class="content">
                                        <h3>База "Луч"</h3>
                                        <div><img src="../img/beach.png" alt="beach">
                                                <div class="info-beach">
                                                        Відстань до пляжу
                                                </div>
                                                <span>24</span> м до пляжа
                                                <img src="../img/home.png" alt="home">
                                                <div class="info-rooms">
                                                        всього номерів
                                                </div>
                                                <span>25</span> кімнат
                                                <img src="../img/lux.png" alt="bath">
                                                <div class="info-bath">
                                                        номерів Люкс
                                                </div>
                                                <span>5</span> номерів Люкс
                                        </div>
                                        <div>
                                                <img src="../img/marker.png" alt="marker">
                                                <span>с.Світязь. вул.Велика Морська 5</span>
                                        </div>
                                        <div>
                                                <img src="../img/phone.png" alt="phone">
                                                <span class="phone">+38 099 444 33 22</span>
                                        </div>
                                        <article>Но только что он вступил в столовую (еще через одну комнату от гостиной), с ним в дверях почти столкнулась выходившая в дверях почти столкнулась </article>

                                        <div class="grey"></div>
                                        <div class="details">
                                                від <span>300</span> грн/доба
                                                <a href="#" class="btn btn-success pull-right">Детальніше</a>
                                        </div>
                                </div>
                        </aside>
                        <aside>
                                <div class="photo">
                                        <img src="../img/hotel.jpg" alt="hotel_photo">
                                        <img src="../img/images.png" alt="images" class="images">
                                </div>
                                <div class="content">
                                        <h3>База "Луч"</h3>
                                        <div><img src="../img/beach.png" alt="beach">
                                                <div class="info-beach">
                                                        Відстань до пляжу
                                                </div>
                                                <span>24</span> м до пляжа
                                                <img src="../img/home.png" alt="home">
                                                <div class="info-rooms">
                                                        всього номерів
                                                </div>
                                                <span>25</span> кімнат
                                                <img src="../img/lux.png" alt="bath">
                                                <div class="info-bath">
                                                        номерів Люкс
                                                </div>
                                                <span>5</span> номерів Люкс
                                        </div>
                                        <div>
                                                <img src="../img/marker.png" alt="marker">
                                                <span>с.Світязь. вул.Велика Морська 5</span>
                                        </div>
                                        <div>
                                                <img src="../img/phone.png" alt="phone">
                                                <span class="phone">+38 099 444 33 22</span>
                                        </div>
                                        <article>Но только что он вступил в столовую (еще через одну комнату от гостиной), с ним в дверях почти столкнулась выходившая в дверях почти столкнулась </article>

                                        <div class="grey"></div>
                                        <div class="details">
                                                від <span>300</span> грн/доба
                                                <a href="#" class="btn btn-success pull-right">Детальніше</a>
                                        </div>
                                </div>
                        </aside>
                        <ul class="pagg">
                                <li><a href="#"><</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">></a></li>
                        </ul>
                </section>
                <section class="banners">
                        <img src="../img/banner.jpg">
                </section>
        </div>
</main>
<section class="other">
                <h2>Інші оголошення</h2>
                <div class="green"></div>
                <div class="grey"></div>
                <aside>
                        <div class="main-photo">
                                <img src="../img/other1.jpg" alt="">
                        </div>
                        <div class="content">
                                <h3>Продам будинок</h3>
                                <div class="grey"></div>
                                <p>
                                <span>250000</span> грн.
                                        <a href="#" class="pull-right">Детальніше
                                                <img src="../img/arrow.svg" alt='->'>
                                        </a>
                                </p>
                        </div>
                </aside>
                <aside>
                        <div class="main-photo">
                                <img src="../img/other2.jpg" alt="">
                        </div>
                        <div class="content">
                                <h3>Продам козу</h3>
                                <div class="grey"></div>
                                <p>
                                <span>250</span> грн.
                                        <a href="#" class="pull-right">Детальніше
                                                <img src="../img/arrow.svg" alt='->'>
                                        </a>
                                </p>
                        </div>
                </aside>
                <aside>
                        <div class="main-photo">
                                <img src="../img/other3.jpg" alt="">
                        </div>
                        <div class="content">
                                <h3>Водні екскурсії</h3>
                                <div class="grey"></div>
                                <p>
                                <span>100</span> грн.
                                        <a href="#" class="pull-right">Детальніше
                                                <img src="../img/arrow.svg" alt='->'>
                                        </a>
                                </p>
                        </div>
                </aside>
                <aside>
                        <div class="main-photo">
                                <img src="../img/other4.jpg" alt="">
                        </div>
                        <div class="content">
                                <h3>Автобусні перевезення</h3>
                                <div class="grey"></div>
                                <p>
                                <span>150</span> грн.
                                        <a href="#" class="pull-right">Детальніше
                                                <img src="../img/arrow.svg" alt='->'>
                                        </a>
                                </p>
                        </div>
                </aside>
        </section>
        <ul class="pagg other">
                <li><a href="#"><</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">></a></li>
        </ul>
<section class="history">
        <h2>Ви переглядали</h2>
        <div class="green"></div>
        <div class="grey"></div>
        <aside>
                <div class="main-photo">
                        <img src="../img/other1.jpg" alt="">
                </div>
                <div class="content">
                        <h3>Продам будинок</h3>
                        <div class="grey"></div>
                        <p>
                        <span>250000</span> грн.
                                <a href="#" class="pull-right">Детальніше
                                        <img src="../img/arrow.svg" alt='->'>
                                </a>
                        </p>
                </div>
        </aside>
        <aside>
                <div class="main-photo">
                        <img src="../img/other1.jpg" alt="">
                </div>
                <div class="content">
                        <h3>Коттедж</h3>
                        <div class="grey"></div>
                        <p>
                        <span>250</span> грн./доба
                                <a href="#" class="pull-right">Детальніше
                                <img src="../img/arrow.svg" alt='->'>
                                </a>
                        </p>
                </div>
        </aside>
        <aside>
                <div class="main-photo">
                        <img src="../img/other1.jpg" alt="">
                </div>
                <div class="content">
                        <h3>Коттедж</h3>
                        <div class="grey"></div>
                        <p>
                        <span>350</span> грн./доба
                                <a href="#" class="pull-right">Детальніше
                                        <img src="../img/arrow.svg" alt='->'>
                                </a>
                        </p>
                </div>
        </aside>
        <aside>
                <div class="main-photo">
                        <img src="../img/other1.jpg" alt="">
                </div>
                <div class="content">
                        <h3>Коттедж</h3>
                        <div class="grey"></div>
                        <p>
                        <span>300</span> грн./доба
                                <a href="#" class="pull-right">Детальніше
                                <img src="../img/arrow.svg" alt='->'>
                                </a>
                        </p>
                </div>
        </aside>
</section>
@endsection