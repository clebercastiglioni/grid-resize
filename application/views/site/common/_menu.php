<input type='checkbox' id="menuControl" />  
<label id="menuLayer" for="menuControl"></label>
<nav id='menu'>
    <div id="menuBar">
        <label id="menuToggle" for="menuControl">
            <div class="menu-bars">
                <div class="menu-bar"></div>
                <div class="menu-bar"></div>
                <div class="menu-bar"></div>
            </div>
        </label>
        <a href="<?php echo base_url() ?>">
            <img src="<?php echo base_url('assets/frontend/img/logo.png'); ?>" title="">
        </a>
    </div>
    <ul>
        <li>
            <a href="#" class="active">Menu item</a>
        </li>
        <li>
            <a href="#">Menu item</a>
        </li>
        <li>
            <a href="#">Menu item</a>
        </li>
        <li>
            <a href="#">Menu item</a>
        </li>
        <li>
            <a href="#">Menu item</a>
        </li>
    </ul>    
</nav>