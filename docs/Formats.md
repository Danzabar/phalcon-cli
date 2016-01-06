Formats
=======

You can add color to your output with the `Danzabar\CLI\Format\Format` class, It allows you to add a foreground and background color and identify them formats with a marquee in the text.

### Creating a format

To create a new format use the static `addFormat`:

	Format::addFormat('name', Array('foreground' => 'black'));

The above format can be used by wrapping your string in `<Name></Name>`, since there is no background specified this format will just make the text black. You use this along with the output class, so in your task you could output:

	$this->output->writeln('<Name>This text will take the format</Name>');

### Default Formats

The class sets up 3 default formats that you can use, or overwrite if you wish:

	<Question></Question> 		- Foreground Cyan
	<Info></Info>				- Foreground Cyan
	<Comment></Comment>			- Foreground Yellow
	<Error></Error>				- Foreground White, Background Red

### Colors

The list of colors available:

#### Foreground

 - black
 - dark_gray
 - blue
 - light_blue
 - green
 - light_green
 - cyan
 - light_cyan
 - red
 - light_red
 - purple
 - light_purple
 - brown
 - yellow
 - light_gray
 - white

#### Background

 - black
 - red
 - green
 - yellow
 - blue
 - magenta
 - cyan
 - light_gray

