import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

class Main {
  public static void main(String args[]) throws IOException {
    String input = new String(Files.readAllBytes(Paths.get("input.txt"))).strip();

    String[] split = input.split("\n");

    Main main = new Main();
    Position position = main.new Position();
    Pattern p = Pattern.compile("(.*) (\\d+)");

    for (String element : split) {
      Matcher m = p.matcher(element);
      if (m.matches()) {
        position.move(m.group(1), Integer.parseInt(m.group(2)));
      }
    }

    long result = position.getX() * position.getZ();

    System.out.println("Result: " + result);
  }

  class Position {
    protected int x = 0;
    protected int z = 0;
    protected int aim = 0;

    public void move(String direction, int length) {
      switch (direction) {
        case "forward":
          x += length;
          z += (aim * length);
          break;
        case "up":
          aim -= length;
          break;
        case "down":
          aim += length;
          break;
        default:
          break;
      }
    }

    public int getX() {
      return x;
    }

    public int getZ() {
      return z;
    }

    public int getAim() {
      return aim;
    }
  }
}
