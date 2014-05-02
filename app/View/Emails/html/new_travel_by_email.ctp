<legend>
    <big>
        <?php if($travel['TravelByEmail']['direction'] == 0):?>
        <span id='travel-locality-label'><?php echo $travel['Locality']['name']?></span> 
        - 
        <span id='travel-where-label'><?php echo $travel['TravelByEmail']['where']?></span>
        <?php else:?>
        <span id='travel-where-label'><?php echo $travel['TravelByEmail']['where']?></span> 
        - 
        <span id='travel-locality-label'><?php echo $travel['Locality']['name']?></span>
        <?php endif?>
    </big> 
</legend>


<p><b>Descripción:</b> <?php echo $travel['TravelByEmail']['description']?></p>