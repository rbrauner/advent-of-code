import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.Scanner;

class Main {
  public static void main(String args[]) throws IOException {
    String input = new String(Files.readAllBytes(Paths.get("input.txt"))).strip();

    long result = 0;

    Scanner scanner = new Scanner(input);

    boolean firstTime = true;
    int prev = 0;
    int current = 0;
    while (scanner.hasNextLine()) {
      current = Integer.parseInt(scanner.nextLine());

      if (firstTime) {
        firstTime = false;
      } else {
        if (current > prev) {
          result++;
        }
      }

      prev = current;
    }

    System.out.println("Result: " + result);
  }
}
