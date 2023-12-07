import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.Scanner;

class Main {
  public static void main(String args[]) throws IOException {
    String input = new String(Files.readAllBytes(Paths.get("input.txt"))).strip();

    long result = 0;

    String[] split = input.split("\n");

    boolean firstTime = true;
    int prev = 0;
    int current = 0;
    int i = 0;
    for (String element : split) {
      current = Integer.parseInt(element);

      if (i + 1 < split.length) {
        current += Integer.parseInt(split[i + 1]);
      }

      if (i + 2 < split.length) {
        current += Integer.parseInt(split[i + 2]);
      }

      if (firstTime) {
        firstTime = false;
      } else {
        if (current > prev) {
          result++;
        }
      }

      prev = current;
      i++;
    }

    System.out.println("Result: " + result);
  }
}
